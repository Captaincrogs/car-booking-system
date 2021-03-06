<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('reservation_start_date');
            $table->date('reservation_end_date');
            $table->time('reservation_time');
            $table->string('status');
            $table->unsignedInteger('car_id');
            $table->unsignedInteger('user_id');
            $table->string('invoice_link')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
