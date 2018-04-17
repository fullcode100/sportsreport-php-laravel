<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class topPost extends Controller
{
    public function topOfTheWeek($month,$day,$year){
    	$rightNow = Carbon::now()->addDay();
    	$inputDate = Carbon::create($year, $month, $day, 23, 59, 59);
    	$sevenDaysPrior = Carbon::create($year, $month, $day, 0, 0, 0)->subDays(7);

        $easy_human_date = Carbon::create($year, $month, $day)->format('F jS, Y');

    	if($inputDate->gt($rightNow)){
    		return redirect('/');
    	}else{
	    	$post_in_range = DB::table('highlights')->where('created_at','<=',$inputDate)->where('created_at','>=',$sevenDaysPrior)->get();

	    	echo "<h1>Post in this range:</h1>";
	    	if(count($post_in_range) <= 0){
	    		return redirect('/');
	    	}else{
	    		return view('topOfTheWeek',['feed_data' => $post_in_range,'date_range' => $easy_human_date]);
	    	}
    	
    	}
    }
}
