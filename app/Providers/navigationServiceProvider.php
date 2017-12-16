<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class navigationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
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
