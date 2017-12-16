<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\tag_model;

class navigationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //Grabs all images from header image folder. Displayers one in header of site.
        view()->composer('layouts.app',function($view){

            $image_directory = './images/header-images/';
            $header_images = glob($image_directory.'*.png');
            $selected_image = $header_images[array_rand($header_images)];

            $view->with('random_header_image',$selected_image);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
