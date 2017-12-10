<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'highlightFeed@homePageFeed');
Route::get('/highlight/{post_id}','highlightFeed@singlePost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// All routes in the group are protected, only authed user are allowed to access them
Route::group(['middleware' => ['auth']], function () {

	//Preview the post, if its good allow the user to add it to the database.
	Route::get('preview-post', function(){
		return view('previewPostForm');
	});

	Route::post('/preview-post-output','interpreter@preview_embeded_post');
	Route::post('/add-new-highlight','interpreter@insert_new_highlight');
	Route::post('/delete-highlight','interpreter@delete_highlight');

});

