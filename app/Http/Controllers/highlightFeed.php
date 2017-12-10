<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\highlight;

class highlightFeed extends Controller
{
    
	public function homePageFeed(){

		$highlight = new highlight();

		$feed_data = $highlight->getPrimaryFeed();

		return view('homePageFeed',['feed_data' => $feed_data]);

	}

	public function singlePost($post_id){
		$single_post_data = highlight::where('highlight_id','=',$post_id)->first();

		return view('singleHighlight',['highlight_data' => $single_post_data]);
	}

}