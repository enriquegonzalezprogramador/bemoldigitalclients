<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('obre_id')->nullable();
            $table->string('activity');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('observation')->nullable();
            $table->string('start_date');
            $table->string('status');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('obre_id')->references('id')->on('obres');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activitys');
    }
}
