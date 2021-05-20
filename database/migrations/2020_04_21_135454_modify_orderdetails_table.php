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
            $table->string('total_price')->after('discount_price')->nullable();
            $table->string('product_image')->after('product_description')->nullable();
            $table->string('accessories_id')->after('size_measure')->nullable();
            $table->longtext('accessories_details')->after('accessories_id')->nullable();
            $table->longtext('measurment_details')->after('measurement_id')->nullable();
            $table->longtext('saree_measurment_details')->after('saree_measurment_ids')->nullable();
            $table->longtext('salwar_measurment_details')->after('salwar_measurment_ids')->nullable();
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
