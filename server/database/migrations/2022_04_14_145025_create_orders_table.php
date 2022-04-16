<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('address_id');
            $table->string('zipcode')->nullable();
            $table->string('payment_method');
            $table->float('total');
            $table->string('status');
            $table->string('shipping_fee');
            $table->string('discount')->nullable();
            $table->float('subtotal');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('orders');
    }
}
