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

	public function singlePost($post_id,$friendly_slug){
		$single_post_data = highlight::where('highlight_id','=',$post_id)->firstOrFail();

		/*
		 *If the slug in the URL doesn't match the one in the database redirect to the correct URL.
		 *This stops duplicate data URLs which hurt our SEO.
		*/
		if($friendly_slug != $single_post_data->url_slug){
			$correct_slug = 'highlight/' . $post_id . '/' . $single_post_data->url_slug;

			return redirect($correct_slug);
		}

		$post_tags = tag_model::getPostTags($post_id);

		$single_post_data->setAttribute('post_tags', $post_tags);

		return view('singleHighlight',['highlight_data' => $single_post_data]);
	}

	/*
	 *We want all our URL's to have words so people can tell what the page contains and so can Google.
	 *If anyone accesses a page just using the post ID this will redirect them to the page with the URL slug as part of the URL.
	*/
	public function sluglessSinglePost($post_id){
		$highlight_data = highlight::where('highlight_id','=',$post_id)->firstOrFail();

		$post_with_slug_url = 'highlight/' . $post_id . '/' . $highlight_data->url_slug;

		return redirect($post_with_slug_url);
	}

	public function highlightsByTag($tag_url){
		$post_ids_in_tag = tag_model::getPostByTag($tag_url);

		$post_under_tag = highlight::postInTag($post_ids_in_tag);

		return view('tagFeed',['feed_data' => $post_under_tag]);
	}

}