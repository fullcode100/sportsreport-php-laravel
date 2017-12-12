<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag_model extends Model
{
    protected $table = 'post_tags';

    protected function getPostTags($post_id){
    	$post_tags = $this->where('post_id','=',$post_id)->get();

    	return $post_tags;
    }

    protected function getPostByTag($url_tag){
    	$post_ids_for_tag = $this->where('tag_url','=',$url_tag)->pluck('post_id');

    	return $post_ids_for_tag;
    }
}
