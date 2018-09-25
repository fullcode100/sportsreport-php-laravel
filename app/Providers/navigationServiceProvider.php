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

            //Scan the image directory and get the file path to all png header images.
            $image_directory = './images/header-images/';
            $header_images = glob($image_directory.'*.png');
            $selected_image = $header_images[array_rand($header_images)];
            $selected_image = ltrim($selected_image, '.');

            $view->with('random_header_image',$selected_image);
        });

        /*
            Grab 5 tags to populate across the top of the site.
            Put the 5 links in the top row under the main site navigation.
        */
        view()->composer('layouts.app',function($view){
            $popular_tags = new tag_model;
            $view->with('popular_tags',$popular_tags->mostPopularTags());
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
