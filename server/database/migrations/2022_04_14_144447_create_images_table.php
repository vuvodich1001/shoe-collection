<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shoe_id');
            $table->unsignedBigInteger('color_id');
            $table->string('image');
            $table->string('image_short');
            $table->boolean('default');
            $table->foreign('shoe_id')->references('id')->on('shoes')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('images');
    }
}
