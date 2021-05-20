<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateProductOrderDetailsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('product_order_details'))
            {
                Schema::create('product_order_details', function (Blueprint $table)
                {
                    $table->bigIncrements('product_order_detail_id');

                    $table->bigInteger('product_order_id')->unsigned();
                    $table->foreign('product_order_id')->references('product_order_id')->on('product_orders')->onDelete('cascade');

                    $table->bigInteger('product_id')->unsigned();
                    $table->foreign('product_id')->references('product_id')->on('products');

                    $table->text('variant_name');
                    $table->integer('product_quantity')->default(1);
                    $table->string('product_code', 50);

                    $table->text('product_name');
                    $table->text('product_description');
                    $table->decimal('product_price')->default(0.0);
                    $table->decimal('discount_price')->default(0.0);
                    $table->decimal('net_price')->default(0.0);

                    $table->tinyInteger('product_status')->default(1)->comment('1:Active, 2:Inactive');
                    $table->tinyInteger('out_of_stock')->default(1)->comment('1:Yes, 2:No');

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
            Schema::dropIfExists('product_order_details');
        }

    }
    