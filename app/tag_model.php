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

    protected function insertNewTags($post_id,$friendly_tag,$url_tag){
    	$this->insert(['post_id' => $post_id,'tag_read' => $friendly_tag,'tag_url' => $url_tag]);
    }

    public function mostPopularTags(){
    	$tag_data = $this->orderby('unique_tag_id','DESC')->take(100)->get();

        $tag_data = $tag_data->has('tag_url','>=',1);
    	dd($tag_data);
    	
    	return arsort($tag_data);
    }
}
