<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

use Auth;

/*
	https://laravel.com/docs/5.8/eloquent-resources
	Laravel added API resources (as of 5.3) a while back. This is something that eventually should be converted to one.
	As opposed to just returning a json resource to the page.
	That said this is functional for now.
*/
class extensionAPI extends Controller
{

	public function __construct()
    {
        $this->middleware('cors');
    }

    public function externalAuthenticationStatus(){

        if(Auth::check()){
            $signed_in = ['logged_in' => true, 'user_name' => Auth::user()->name];
            $signed_in = json_encode($signed_in);

            return $signed_in;
        }

        $signed_in = ['logged_in' => false, 'user_name' => null];
        $signed_in = json_encode($signed_in);

        return $signed_in;
    }

    public function cacheWebClip(Request $preview_embed_content_request){

    	$clipping_data = ['success' => false,'return'=> null];

    	$embeded_content_validation = Validator::make($preview_embed_content_request->all(), [
			'content_source'=>'required|in:instagram,twitter,imgur,gfycat,youtube,streamable,static',
			'content_url' => 'required|url',
		]);

		if ($embeded_content_validation->fails()) {
			$clipping_data['return'] = 'Media source or URL is invalid, or missing.';
			$clipping_data = json_encode($clipping_data);
			return $clipping_data;
		}

		$cache_key = 'source_' . $preview_embed_content_request->content_source . '-time_' . date('m-d-Y_H-s');
		$cache_data = ['content_source' => $preview_embed_content_request->content_source, 'content_url' => $preview_embed_content_request->content_url];

		Cache::put($cache_key, $cache_data, 21600);

		$clipping_data['return'] = $cache_key;
		$clipping_data['success'] = true;

		$clipping_data = json_encode($clipping_data);
		return $clipping_data;
    }
}
