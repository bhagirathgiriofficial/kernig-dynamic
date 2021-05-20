<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateProductOrdersTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('product_orders'))
            {
                Schema::create('product_orders', function (Blueprint $table)
                {
                    $table->bigIncrements('product_order_id');

                    $table->bigInteger('user_id')->unsigned();
                    $table->foreign('user_id')->references('id')->on('users');

                    // $table->bigInteger('delivery_area_id')->unsigned();
                    // $table->foreign('delivery_area_id')->references('delivery_area_id')->on('delivery_areas');

                    $table->dateTime('order_date');
                    $table->string('order_number', 255)->default('');

                    $table->decimal('total_amount')->default(0.0);
                    $table->integer('product_quantity')->default(0);
                    $table->decimal('discount_amount')->default(0.0);
                    $table->decimal('net_amount')->default(0.0);
                    $table->decimal('shipping_charge')->default(0.0);

                    $table->string('user_name', 255)->default('');
                    $table->string('user_email', 255)->default('')->nullable();
                    $table->string('user_mobile_number', 255)->default('');
                    $table->text('shipping_address');

                    $table->tinyInteger('payment_mode')->default(1)->comment('1:COD, 2:Other');
                    $table->tinyInteger('order_status')->default(1)->comment('1:Success, 2:Cancelled, 3:Failed, 4: Return');
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
            Schema::dropIfExists('product_orders');
        }

    }
    