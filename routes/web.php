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

use App\Http\Resources\WebClipper;

Route::get('/', 'highlightFeed@homePageFeed');
Route::get('/page/{page_set}', 'highlightFeed@highlightPages');
//If the URL is accessed without a slug this route will redirect them to that page/highlight but with a slug as part of the URL.
Route::get('/highlight/{post_id}','highlightFeed@sluglessSinglePost');
Route::get('/highlight/{post_id}/{friendly_slug}','highlightFeed@singlePost');
Route::get('/tagged/{tag_url}','highlightFeed@highlightsByTag');

    //Auth::routes();

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    //Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    //Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/api/user_status', 'extensionAPI@externalAuthenticationStatus');

Route::get('/top-of-the-week/{month}/{day}/{year}','topPost@topOfTheWeek');
Route::get('all-top-of-the-weeks','topPost@allWeeks');

// All routes in the group are protected, only authed user are allowed to access them
Route::group(['middleware' => ['auth']], function () {

	//Preview the post, if its good allow the user to add it to the database.
	Route::get('preview-post', function(){
		return view('previewPostForm');
	});

	Route::post('/preview-post-output','interpreter@preview_embeded_post');
	Route::post('/add-new-highlight','interpreter@insert_new_highlight');
	Route::post('/delete-highlight','interpreter@delete_highlight');

    Route::post('/new-tag-set','tagging@tagTranslator');

     Route::get('new-top-of-the-week', function(){
        return view('addNewTopOfTheWeek');
    });

    Route::post('/add-new-top-of-the-week','topPost@addNew');

    Route::get('/new_api_key', 'HomeController@updateAPIKey');
    Route::get('/web_clip_highlight_preview/{cache_key}','interpreter@web_clipper_preview');
});
