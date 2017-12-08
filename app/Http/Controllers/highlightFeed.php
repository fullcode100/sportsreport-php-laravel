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

}
