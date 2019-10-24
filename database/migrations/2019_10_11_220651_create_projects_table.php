<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->longText('address');
            $table->longText('ubication')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('start_date');
            $table->unsignedBigInteger('employee_id');
            $table->string('status');
            $table->timestamps();

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
        Schema::dropIfExists('projects');
    }
}
