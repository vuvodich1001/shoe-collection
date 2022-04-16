<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('shoe_id');
            $table->integer('quantity');
            $table->float('subtotal');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('shoe_id')->references('id')->on('shoes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('order_details');
    }
}
