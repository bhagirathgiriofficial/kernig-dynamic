<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->bigIncrements('shipping_id');
            $table->unsignedBigInteger('shipping_country_id');
            $table->foreign('shipping_country_id')->references('countries')->on('country_id');
            $table->float('shipping_weight');
            $table->float('shipping_price');
            $table->boolean('shipping_status')->comment('1 = Active , 0 = Inactive')->default('1');
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
        Schema::dropIfExists('shipping_charges');
    }
}
