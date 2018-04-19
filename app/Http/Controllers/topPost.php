<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

use Illuminate\Support\Facades\Validator;

use App\weeklyRecap;

class topPost extends Controller
{
    public function topOfTheWeek($month,$day,$year){

        $requested_week = weeklyRecap::where('month','=',$month)->where('day','=',$day)->where('year','=',$year)->first();
        
        if ($requested_week === null) {
           return redirect('/all-top-of-the-weeks');
        }

    	$rightNow = Carbon::now()->addDay();
    	$inputDate = Carbon::create($year, $month, $day, 23, 59, 59);
    	$sevenDaysPrior = Carbon::create($year, $month, $day, 0, 0, 0)->subDays(7);

        $easy_human_date = Carbon::create($year, $month, $day)->format('F jS, Y');

    	if($inputDate->gt($rightNow)){
    		return redirect('/');
    	}else{
	    	$post_in_range = DB::table('highlights')->where('created_at','<=',$inputDate)->where('created_at','>=',$sevenDaysPrior)->get();

	    	if(count($post_in_range) <= 0){
	    		return redirect('/');
	    	}else{
	    		return view('topOfTheWeek',['feed_data' => $post_in_range,'date_range' => $easy_human_date]);
	    	}
    	
    	}
    }

    public function addNew(Request $Request){
        $top_of_the_week_data_validator = Validator::make($Request->all(), [
            'month' =>'required|integer|min:1|max:12',
            'day' =>'required|integer|min:1|max:31',
            'year' =>'required|integer|min:2017|max:2019',
            'vanity_url' => 'url|nullable',
            'description' => 'string|nullable|max:500'
        ]);

        if ($top_of_the_week_data_validator->fails()) {
            return back()->withInput()->withErrors($tag_data_validation);
        }

        $add_new_week = new weeklyRecap();

        $add_new_week->createNewWeek($Request);

        return redirect('/all-top-of-the-weeks');

    }

    public function allWeeks(){
        $all_weeks = weeklyRecap::all();
        return view('topOfTheWeekList',['week_list' => $all_weeks]);
    }
}
