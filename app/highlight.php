<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class highlight extends Model
{
    //
    public $timestamps = true;
    private $number_of_post = 7;

    public function getPrimaryFeed(){
    	return $this->orderBy('highlight_id','desc')->take($this->number_of_post)->get();
    }

    protected function postInTag($post_id_array){
    	return $this->wherein('highlight_id',$post_id_array)->orderby('highlight_id','DESC')->get();
    }

    

}
