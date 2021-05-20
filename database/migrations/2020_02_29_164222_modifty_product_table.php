<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModiftyProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // $table->dropColumn('in_top_deal');
            // $table->dropColumn('is_best_selling');
            // $table->dropForeign('products_category_id_foreign');
            // $table->dropColumn('category_id');
            // $table->dropColumn('variant_id');
            // $table->dropColumn('product_discount');
            // $table->dropColumn('net_price');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('product_categories')->after('product_code')->default('')->comment('Multiple ids of category');
            $table->string('product_colors')->after('product_categories')->default('')->comment('Multiple ids of color');
            $table->string('product_fabrics')->after('product_colors')->default('')->comment('Multiple ids of fabric');
            $table->string('product_occasions')->after('product_fabrics')->default('')->comment('Multiple ids of occasions');
            $table->string('product_sizes')->after('product_occasions')->default('')->comment('Multiple ids of sizes');
            $table->string('product_accessories')->after('product_sizes')->default('')->comment('Multiple ids of accesories');
            $table->integer('product_type')->after('product_code')->nullable()->comment('1 - New 2 - Sale 3 - Special');
            $table->decimal('product_discounted_price')->after('product_price')->nullable();
            $table->text('product_notes')->after('product_description')->nullable();
            $table->string('product_timetoship')->after('product_notes')->default('');
            $table->string('product_image')->after('product_timetoship')->default('');
            $table->double('product_weight')->after('product_timetoship')->nullable();
            $table->integer('product_views')->after('product_type')->default(0)->comment('Total Views');
            $table->unsignedBigInteger('measurement_id')->after('product_code')->nullable();
            $table->foreign('measurement_id')->references('measurement_id')->on('measurements');
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
