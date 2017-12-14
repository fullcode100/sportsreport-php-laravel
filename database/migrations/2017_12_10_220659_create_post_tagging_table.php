<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTaggingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tags', function (Blueprint $table) {
            $table->increments('unique_tag_id');
            $table->integer('post_id');
            $table->char('tag_read', 100);
            $table->char('tag_url', 100);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_tags', function (Blueprint $table) {
            //
        });
    }
}
