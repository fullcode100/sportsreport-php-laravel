<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\tag_model;

class tagging extends Controller
{
    
	public function tagTranslator(Request $tag_data){

		$tag_data_validation = Validator::make($tag_data->all(), [
			'highlight_id' =>'required|exists:highlights,highlight_id',
			'tags' => ['required', 'regex:^[a-zA-Z0-9,.!? ]*$^','filled','max:100']
		]);

		if ($tag_data_validation->fails()) {
			return back()
				->withInput()
				->withErrors($tag_data_validation);
		}

		$tag_array = explode(",", $tag_data->tags);

		//Empty collection tag data will be fed into.
		$full_tag_set = collect();

		$number_of_tags = count($tag_array);

		for($i = 0;$i < $number_of_tags;$i++){

			$create_url_tag = preg_replace('/[^\w]/', '_', strtolower($tag_array[$i]));

			$full_tag_set->push(['friendly_tag' => $tag_array[$i],'url_tag' => $create_url_tag]);
		}


		foreach($full_tag_set as $single_tag){
			tag_model::insertNewTags($tag_data->highlight_id,$single_tag['friendly_tag'],$single_tag['url_tag']);
		}
 

		return back();
	}

}
