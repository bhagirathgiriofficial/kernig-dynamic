<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_orders', function (Blueprint $table) {
            $table->dropColumn('user_name');
            $table->dropColumn('user_email');
            $table->dropColumn('user_mobile_number');
            $table->dropColumn('shipping_address');
            $table->dropColumn('payment_mode');
            $table->dropColumn('order_status');
        });

        Schema::table('product_orders', function (Blueprint $table) {

            $table->integer('bill_shipping')->after('net_amount')->nullable()->comment('1 - Same as billing');
            $table->tinyInteger('order_gift')->after('bill_shipping')->default(0)->comment('0:No, 1:Yes');
            $table->string('billing_first_name')->after('order_gift')->default('');
            $table->string('billing_last_name')->after('billing_first_name')->default('');
            $table->string('billing_email')->after('billing_last_name')->default('');
            $table->string('billing_phone')->after('billing_email')->default('');
            $table->text('billing_address')->after('billing_phone')->nullable();
            $table->string('billing_city')->after('billing_address')->default('');
            $table->string('billing_state')->after('billing_city')->default('');
            $table->string('billing_pincode')->after('billing_state')->default('');
            $table->string('billing_country')->after('billing_pincode')->default('');
            $table->string('shipping_first_name')->after('billing_country')->default('');
            $table->string('shipping_last_name')->after('shipping_first_name')->default('');
            $table->string('shipping_email')->after('shipping_last_name')->default('');
            $table->string('shipping_phone')->after('shipping_email')->default('');
            $table->text('shipping_address')->after('shipping_phone')->nullable();
            $table->string('shipping_city')->after('shipping_address')->default('');
            $table->string('shipping_state')->after('shipping_city')->default('');
            $table->string('shipping_pincode')->after('shipping_state')->default('');
            $table->string('shipping_country')->after('shipping_pincode')->default('');
            $table->tinyInteger('payment_mode')->after('shipping_country')->default(1)->comment('1:COD, 2:PayPal, 3:Other');
            $table->tinyInteger('order_status')->after('payment_mode')->default(1)->comment('1:In Process, 2:Shipped, 3:Out for Delivery, 4:Completed , 5: Cancelled, 6: Return');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
