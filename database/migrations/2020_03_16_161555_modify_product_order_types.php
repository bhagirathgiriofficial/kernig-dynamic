<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyProductOrderTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('product_orders',function($table)
          {
             $table->dropColumn('order_status');
              
          });

          Schema::table('product_orders',function($table)
          {
             $table->tinyInteger('order_status')->default(1)->comment('1:Order Placed, 2:Processed, 3:Out for delivery, 4:Completed , 5: Canceled, 6: Return')->after('payment_mode');
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
