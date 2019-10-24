<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaImagesobres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagesobres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('name');
            $table->unsignedBigInteger('obre_id');
            $table->timestamps();

            $table->foreign('obre_id')->references('id')->on('obres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagesobres');
    }
}
