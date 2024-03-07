<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignID('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreignID('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('reserve_day');
            $table->string('reserve_time');
            $table->integer('reserve_people');
            $table->text('reserve_message');
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
        Schema::dropIfExists('reservations');
    }
};
