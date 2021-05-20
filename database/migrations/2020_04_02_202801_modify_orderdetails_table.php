<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyOrderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('product_order_details', function (Blueprint $table) {
            $table->integer('size_id')->after('discount_price')->default(0);
            $table->string('saree_measurment_ids')->after('custom_measurement')->nullable();
            $table->string('salwar_measurment_ids')->after('saree_measurement')->nullable();
            $table->text('salwar_measurment')->after('salwar_measurment_ids')->nullable();
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
