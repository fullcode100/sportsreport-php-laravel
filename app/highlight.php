<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class highlight extends Model
{
    //
    public $timestamps = true;

    protected function postInTag($post_id_array){
    	return $this->wherein('highlight_id',$post_id_array)->orderby('highlight_id','DESC')->get();
    }

}
