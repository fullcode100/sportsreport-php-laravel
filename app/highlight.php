<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class highlight extends Model
{
    //
    public $timestamps = true;

    public function getPrimaryFeed(){

    	return $this->orderBy('highlight_id','desc')->take(50)->get();

    }

}
