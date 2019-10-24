<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaImagesactivitys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagesactivitys', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('name');
            $table->unsignedBigInteger('activity_id');
            $table->timestamps();

            $table->foreign('activity_id')->references('id')->on('activitys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagesactivitys');
    }
}
