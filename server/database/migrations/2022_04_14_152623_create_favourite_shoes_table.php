<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouriteShoesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('favourite_shoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shoe_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('shoe_id')->references('id')->on('shoes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('favourite_shoes');
    }
}
