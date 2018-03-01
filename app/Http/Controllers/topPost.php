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


    	if($inputDate->gt($rightNow)){
    		echo "You can't look into the future.";
    	}else{

    		echo "<i>Right now</li> it is: " . $rightNow;
    		echo "<br>The input date is: " . $inputDate->format('l jS \\of F Y h:i:s A');
    		echo "<br>Seven days prior to that is: " . $sevenDaysPrior->format('l jS \\of F Y h:i:s A');
    		echo "<br>As timestamps those are: " . $inputDate . " and " . $sevenDaysPrior;

    		//echo "<br><br><br>Input date plus one: " . $inputDate->addDays(1);
	    	$post_in_range = DB::table('highlights')->where('created_at','<=',$inputDate)->where('created_at','>=',$sevenDaysPrior)->get();

	    	echo "<h1>Post in this range:</h1>";
	    	if(count($post_in_range) <= 0){
	    		echo "No post to fetch.";
	    	}else{
	    		dump($post_in_range);
	    	}
    	
    	}
    }
}
