<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class weeklyRecap extends Model
{
    //
    protected $table = 'topOfTheWeek';

    public function createNewWeek($week_data){
    	$this->month = $week_data->month;
		$this->day = $week_data->day;
		$this->year = $week_data->year;
		$this->vanity = $week_data->vanity_url;
		$this->description = $week_data->description;
		$this->save();
    }
}
