<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

use App\highlight;

class interpreter extends Controller
{

	private $embed_html_response;

	//An array of all currently supported media services for automatically parsing embeding.
	private $valid_sources = ["instagram","twitter","imgur","gfycat","youtube"];

	//Determines the media conent source and parses the embeding for that given source.
	public function mediaSource($source_type,$source_url){

		switch($source_type){
			case 'instagram':
				$embed_html_response = $this->instagram_embed($source_url);
				break;
			case 'youtube':
				$embed_html_response = $this->youtube_embed($source_url);
				break;
			case 'twitter':
				$embed_html_response = $this->twitter_embed($source_url);
				break;
			case 'streamable':
				$embed_html_response = $this->streamable_embed($source_url);
				break;
			case 'gfycat':
				$embed_html_response = $this->gfycat_embed($source_url);
				break;
			case 'imgur':
				$embed_html_response = $this->imgur_embed($source_url);
				break;
			case 'static':
				$embed_html_response = $this->static_embed($source_url);
				break;
			default:
				$embed_html_response = null;
		}

		$embed_preview_data = ['source_url' => $source_url,'source_site' => $source_type,'raw_embed_html' => $embed_html_response];

		return view('postPreview',['post_preview_data' => $embed_preview_data]);
	}


	/*
	 * This block of functions will contain various URL processors.
	 * Basically they will return html code that is embeded content from any various defined media service.
	*/
	private function instagram_embed($insta_url){
		$build_url = 'https://api.instagram.com/oembed/?url=' . $insta_url;

		$insta_json_response = file_get_contents($build_url);

		$insta_json_response = json_decode($insta_json_response);

		return $insta_json_response->html;
	}

	private function twitter_embed($tweet_url){
		$build_url = 'https://publish.twitter.com/oembed?url=' . $tweet_url;

		$twitter_json_response = file_get_contents($build_url);

		$twitter_json_response = json_decode($twitter_json_response);

		return $twitter_json_response->html;
	}

	private function streamable_embed($streamable_url){
		$build_url = 'https://api.streamable.com/oembed.json?url=' . $streamable_url;

		$streamable_json_response = file_get_contents($build_url);

		$streamable_json_response = json_decode($streamable_json_response);

		/*
			Streamable attempts to embed videos at their natural size. We want to scale them down.
			This is hacky right now for 720 and 1080 resolution videos. In the future we'll want to do better with regex matching to probably set these scales dynamicall.
		*/
		$streamable_json_response->html = str_replace('width="1280"','width="100%"',$streamable_json_response->html);
		$streamable_json_response->html = str_replace('height="720"','height="550"',$streamable_json_response->html);

		$streamable_json_response->html = str_replace('width="1920"','width="100%"',$streamable_json_response->html);
		$streamable_json_response->html = str_replace('height="1080"','height="550"',$streamable_json_response->html);

		return $streamable_json_response->html;
	}

	private function youtube_embed($youtube_url){
		$strip_youtube_url = trim(substr($youtube_url, strpos($youtube_url, '?v=') + 3));

		$youtube_embed_url = 'https://www.youtube.com/embed/' . $strip_youtube_url;

		$youtube_formed_embed_code = '<iframe width="100%" height="450" style="max-height: 450px;" src="' . $youtube_embed_url . '" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>';

		return $youtube_formed_embed_code;
	}

	private function gfycat_embed($gfycat_url){
		$gfycat_url = rtrim($gfycat_url, '/');

		//gfycat doesn't have a set URL structure. Sometimes the feature detail strings. Other times its a straight resource. We have to account for this.
		if(strpos($gfycat_url, 'detail/') !== false){
			$strip_gfycat_url = trim(substr($gfycat_url, strpos($gfycat_url, 'detail/') + 7));
		}else{
			$strip_gfycat_url = substr($gfycat_url, strrpos($gfycat_url, '/' )+1);
		}

		$gfycat_embed_url = 'https://gfycat.com/ifr/' . $strip_gfycat_url;

		$gfycat_formed_embed_code = '<div style="position:relative;padding-bottom:54%"><iframe src="' . $gfycat_embed_url . '" frameborder="0" scrolling="no" width="100%" height="100%" style="position:absolute;top:0;left:0" allowfullscreen></iframe></div>';

		return $gfycat_formed_embed_code;
	}

	private function imgur_embed($imgur_url){
		$strip_imgur_url = trim(substr($imgur_url, strpos($imgur_url, 'imgur.com/') + 10));

		$imgur_formed_embed_code = '<blockquote class="imgur-embed-pub" lang="en" data-id="' . $strip_imgur_url . '"><a href="' . $imgur_url . '"></a></blockquote><script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>';

		return $imgur_formed_embed_code;
	}

	private function static_embed($static_url){

		$imgur_formed_embed_code = '<img src="' . $static_url . '" class="img-fluid">';

		return $imgur_formed_embed_code;
	}


	/**
	  * Takes in data from the submitted form and previews it in the page.
	  * This allows us to make sure everything went ok when requesting or pasing embeding data before something is posted.
	  * @param Request
	  * @return view
	  **/
	public function preview_embeded_post(Request $preview_embed_content_request){
		
		$embeded_content_validation = Validator::make($preview_embed_content_request->all(), [
			'content_source'=>'required|in:instagram,twitter,imgur,gfycat,youtube,streamable,static',
			'content_url' => 'required|url',
		]);

		if ($embeded_content_validation->fails()) {
			return back()
				->withInput()
				->withErrors($embeded_content_validation);
		}

		return $this->mediaSource($preview_embed_content_request->content_source,$preview_embed_content_request->content_url);
	}

	/**
	  * Basically a duplicate of the above function. However this is used to load cached data from the web clipper extension.
	  * @param Request
	  * @return view
	  **/
	public function web_clipper_preview($cache_key){
		
		if (Cache::has($cache_key)) {
			$cached_preview = Cache::get($cache_key);
    		return $this->mediaSource($cached_preview['content_source'],$cached_preview['content_url']);
		}

		return redirect('home')->withErrors(['msg', 'Post cannot be found.']);
	}

	//After a highlight has been previewed we'll want to do a final validation on all its information and then insert it into the database.
	public function insert_new_highlight(Request $add_highlight_request){
		
		$embeded_content_validation = Validator::make($add_highlight_request->all(), [
			'content_origin_source'=>'required|in:instagram,twitter,imgur,gfycat,youtube,streamable,static',
			'content_origin_url' => 'required|url',
			'highlight_title' => 'required|string',
			'highlight_description' => 'nullable|string',
			'content_embed_html' => 'required|url',
		]);

		if ($embeded_content_validation->fails()) {
			return redirect('/preview-post')
				->withInput()
				->withErrors($embeded_content_validation);
		}

		$embed_html_data = $this->mediaSource($add_highlight_request->content_origin_source,$add_highlight_request->content_embed_html);
		$embed_html_data = $embed_html_data->post_preview_data['raw_embed_html'];

		$slug_seo_url = $this->create_url_slug($add_highlight_request->highlight_title);

		highlight::insert(['highlight_title' => $add_highlight_request->highlight_title, 'origin_url' => $add_highlight_request->content_origin_url, 'embed_data' => $embed_html_data,'highlight_description' => $add_highlight_request->highlight_description, 'url_slug' => $slug_seo_url,'service_origin' => $add_highlight_request->content_origin_source,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')]);

		return redirect('/');
	}

	/**
	  *Deletes a highlight from the database based off the highlight ID
	  *	@param Request
	  *	@return mixed
	*/
	public function delete_highlight(Request $remove_highlight_request){
		
		$remove_highlight_validation = Validator::make($remove_highlight_request->all(), [
			'highlight_unique_id'=>'required|exists:highlights,highlight_id',
		]);

		if ($remove_highlight_validation->fails()) {
			return back()
				->withInput()
				->withErrors($remove_highlight_validation);
		}

		highlight::where('highlight_id','=',$remove_highlight_request->highlight_unique_id)->delete();

		return redirect('/');
	}

	protected function create_url_slug($title_or_string){
		//Honestly... Thanks someone on Stackoverflow for just doing all this regex to make friendly URL https://stackoverflow.com/questions/11330480/strip-php-variable-replace-white-spaces-with-dashes#
		$title_or_string = strtolower($title_or_string);
		$title_or_string = preg_replace("/[^a-z0-9_\s-]/", "", $title_or_string);
		$title_or_string = preg_replace("/[\s-]+/", " ", $title_or_string);
		$title_or_string = preg_replace("/[\s_]/", "-", $title_or_string);

		return $title_or_string;
	}
}
