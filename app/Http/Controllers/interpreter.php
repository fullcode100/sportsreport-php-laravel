<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\highlight;

class interpreter extends Controller
{

	private $embed_html_response;

	private $valid_sources = ["instagram","twitter","imgur","gfycat","youtube"];

	public function mediaSource($source_type,$source_url){

		switch($source_type){
			case 'instagram':
				$embed_html_response = $this->instagram_embed($source_url);
				break;
			case 'youtube':
				$embed_html_response = $this->youtubeEmbed($source_url);
				break;
			case 'twitter':
				$embed_html_response = $this->twitter_embed($source_url);
				break;
			case 'streamable':
				$embed_html_response = $this->streamable_embed($source_url);
				break;
			default:
				$embed_html_response = null;
		}

		$embed_preview_data = ['source_url' => $source_url,'source_site' => $source_type,'raw_embed_html' => $embed_html_response];

		return view('postPreview',['post_preview_data' => $embed_preview_data]);
	}


	/*
	*This block of functions will contain various URL processors.
	*Basically they will return html code that is embeded content from any various defined media service.
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

		return $streamable_json_response->html;
	}

	private function youtubeEmbed($youtube_url){
		$strip_youtube_url = trim(substr($youtube_url, strpos($youtube_url, '?v=') + 3));

		$youtube_embed_url = 'https://www.youtube.com/embed/' . $strip_youtube_url;

		$youtube_formed_embed_code = '<iframe width="800" height="450" src="' . $youtube_embed_url . '" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>';

		return $youtube_formed_embed_code;
	}


	//Takes in data from the previewed post form. Validates it, passes it off to the mediaSource function.
	public function preview_embeded_post(Request $preview_embed_content_request){
		
		$embeded_content_validation = Validator::make($preview_embed_content_request->all(), [
			'content_source'=>'required|in:instagram,twitter,imgur,gfycat,youtube,streamable',
			'content_url' => 'required|url',
		]);

		if ($embeded_content_validation->fails()) {
			return back()
				->withInput()
				->withErrors($embeded_content_validation);
		}

		return $this->mediaSource($preview_embed_content_request->content_source,$preview_embed_content_request->content_url);
	}

	public function insert_new_highlight(Request $add_highlight_request){
		
		$embeded_content_validation = Validator::make($add_highlight_request->all(), [
			'content_origin_source'=>'required|in:instagram,twitter,imgur,gfycat,youtube,streamable',
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



		highlight::insert(['highlight_title' => $add_highlight_request->highlight_title, 'origin_url' => $add_highlight_request->content_origin_url, 'embed_data' => $embed_html_data,'highlight_description' => $add_highlight_request->highlight_description, 'service_origin' => $add_highlight_request->content_origin_source]);

		return redirect('/');
	}
}
