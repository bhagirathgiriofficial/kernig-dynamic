<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductEnquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_enquiry', function (Blueprint $table) {
            $table->bigIncrements('product_enquiry_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->string('product_item_code',150);
            $table->string('enquiry_first_name')->default('');
            $table->string('enquiry_last_name')->default('');
            $table->string('enquiry_email')->default('');
            $table->string('enquiry_phone',16)->nullable();
            $table->text('enquiry_comment')->nullable();
            $table->enum('enquiry_status',['1' , '2'])->comment('1 = Pending , 2 = Replyed')->default(1);
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
        Schema::dropIfExists('product_enquiry');
    }
}
