<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('category')->nullable();
            $table->string('seats')->nullable();
            $table->boolean('gps')->nullable();
            $table->integer('horsepower')->nullable();
            $table->integer('top_speed')->nullable();
            $table->integer('daily_price')->nullable();
            $table->integer('amount')->nullable();
            $table->string('licence_plate')->nullable();
            $table->string('image')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
