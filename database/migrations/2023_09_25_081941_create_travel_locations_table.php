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
        Schema::create('travel_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->references('id')->on('bravo_tours')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('location_id')->references('id')->on('bravo_locations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('map_lat')->nullable();
            $table->string('map_lng')->nullable();
            $table->string('map_zoom')->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('travel_locations');
    }
};
