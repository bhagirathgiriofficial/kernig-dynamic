<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->bigIncrements('enquiry_id');
            $table->string('enquiry_item_code',150);
            $table->text('product_name');
            $table->string('enquiry_user_name')->nullable();
            $table->string('enquiry_email');
            $table->string('enquiry_phone',10);
            $table->text('enquiry_comment');
            $table->enum('enquiry_status',['1' , '2'])->comment('1 = Pending , 2 = Replied')->default(1);
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
        Schema::dropIfExists('enquiries');
    }
}
