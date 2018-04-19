<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTopOfTheWeekData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topOfTheWeek', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('month');
            $table->tinyInteger('day');
            $table->integer('year');
            $table->char('vanity', 100)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topOfTheWeek');
    }
}
