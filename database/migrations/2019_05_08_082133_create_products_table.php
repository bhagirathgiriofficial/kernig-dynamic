<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateProductsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */ 
        public function up()
        {
            if (!Schema::hasTable('products'))
            {
                Schema::create('products', function (Blueprint $table)
                {
                    $table->bigIncrements('product_id');
                    $table->bigInteger('category_id')->unsigned();
                    $table->foreign('category_id')->references('category_id')->on('categories');
                    $table->string('product_code', 100)->default('');
                    $table->text('product_name');
                    $table->text('product_description');
                    $table->text('product_slug');
                    $table->text('variant_id');
                    $table->decimal('product_price');
                    $table->decimal('product_discount');
                    $table->decimal('net_price');
                    $table->tinyInteger('product_status')->default(1)->comment('1:Active, 2:Inactive');
                    $table->tinyInteger('out_of_stock')->default(1)->comment('1:Yes, 2:No');
                    $table->tinyInteger('in_top_deal')->default(2)->comment('1:Yes, 2:No');
                    $table->tinyInteger('is_best_selling')->default(2)->comment('1:Yes, 2:No');

                    $table->timestamps();
                });
            }
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('products');
        }

    }
    