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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignID('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('price');
            $table->string('business_hours');
            $table->string('postal_code');
            $table->string('address');
            $table->string('phone');
            $table->string('regular_holiday');
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
        Schema::dropIfExists('shops');
    }
};
