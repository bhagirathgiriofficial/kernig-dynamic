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
            $table->dropColumn('variant_name');
            $table->dropColumn('hsl_code');
            $table->dropColumn('net_price');
            $table->dropColumn('out_of_stock');
        });

        Schema::table('product_order_details', function (Blueprint $table) {
            $table->decimal('size_measure')->after('discount_price')->default(0.0);
            $table->text('custom_measurement')->after('size_measure')->nullable();
            $table->text('saree_measurement')->after('custom_measurement')->nullable();
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
