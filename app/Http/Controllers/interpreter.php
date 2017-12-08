<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class interpreter extends Controller
{

	private $embed_html_response;

	private $valid_sources = ["instagram","twitter","imgur","gfycat","youtube"];

	public function mediaSource($source_type,$source_url){

		switch($source_type){
			case 'instagram':
				$embed_html_response = $this->instagram_embed($source_url);
				break;
			default:
				$embed_html_response = null;
		}

		$embed_preview_data = ['source_url' => $source_url,'source_site' => $source_type,'raw_embed_html' => $embed_html_response];

		return view('postPreview',['post_preview_data' => $embed_preview_data]);
	}


	private function instagram_embed($insta_url){
		$build_url = 'https://api.instagram.com/oembed/?url=' . $insta_url;

		$insta_json_response = file_get_contents($build_url);

		$insta_json_response = json_decode($insta_json_response);

		return $insta_json_response->html;
	}


	//Do some basic form validation, then
	public function preview_embeded_post(Request $preview_embed_content_request){
		
		$embeded_content_validation = Validator::make($preview_embed_content_request->all(), [
			'content_source'=>'required|in:instagram,twitter,imgur,gfycat,youtube',
			'content_url' => 'required|url',
		]);

		if ($embeded_content_validation->fails()) {
			return redirect('/#validatio-failed')
				->withInput()
				->withErrors($embeded_content_validation);
		}

		return $this->mediaSource($preview_embed_content_request->content_source,$preview_embed_content_request->content_url);
		
	}
}
