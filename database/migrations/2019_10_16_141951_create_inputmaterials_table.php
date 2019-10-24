<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputmaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputmaterials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('inventary_id')->nullable();
            $table->integer('quantity');
            $table->integer('price');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('observation')->nullable();
            $table->string('start_date');
            $table->string('status')->nullable();;
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('inventary_id')->references('id')->on('inventarys');
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
        Schema::dropIfExists('inputmaterials');
    }
}
