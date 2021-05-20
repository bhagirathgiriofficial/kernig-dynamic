<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->unsignedBigInteger('order_user_id');
            $table->foreign('order_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('order_product_id');
            $table->foreign('order_product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->tinyInteger('order_quantity');
            $table->tinyInteger('order_status')->comment('1 = Progress , 2 = Shipped , 3 = Completed');
            $table->dateTime('ordered_at');
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
        Schema::dropIfExists('orders');
    }
}
