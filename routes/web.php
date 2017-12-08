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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Create new category form and validation route
Route::get('preview-post', function(){
	return view('previewPostForm');
});

Route::post('/preview-post-output','interpreter@preview_embeded_post');