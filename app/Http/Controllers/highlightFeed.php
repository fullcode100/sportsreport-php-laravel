<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\highlight;
use App\tag_model;

class highlightFeed extends Controller
{
    
	public function homePageFeed(){

		$highlight = new highlight();

		$feed_data = $highlight->getPrimaryFeed();

		return view('homePageFeed',['feed_data' => $feed_data]);

	}

	public function singlePost($post_id){
		$single_post_data = highlight::where('highlight_id','=',$post_id)->firstOrFail();

		$post_tags = tag_model::getPostTags($post_id);

		$single_post_data->setAttribute('post_tags', $post_tags);

		return view('singleHighlight',['highlight_data' => $single_post_data]);
	}

	public function highlightsByTag($tag_url){
		$post_ids_in_tag = tag_model::getPostByTag($tag_url);

		$post_under_tag = highlight::postInTag($post_ids_in_tag);

		return view('tagFeed',['feed_data' => $post_under_tag]);
	}

}