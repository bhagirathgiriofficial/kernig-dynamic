<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_carts', function (Blueprint $table) {
            $table->dropForeign('product_carts_product_id_foreign');
            $table->dropColumn('product_id');
            $table->dropColumn('product_quantity');
            $table->dropColumn('product_price');
            $table->dropColumn('product_weight');
        });

        Schema::table('product_carts', function (Blueprint $table) {
            $table->longtext('cart')->after('user_id')->nullable();
            $table->longtext('assessories')->after('cart')->nullable();
            $table->longtext('custom_measurment')->after('cart')->nullable();
            $table->longtext('saree_measurment')->after('custom_measurment')->nullable();
            $table->longtext('salwar_measurment')->after('saree_measurment')->nullable();
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
