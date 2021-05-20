<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCartsTable extends Migration
{

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('product_carts'))
            {
                Schema::create('product_carts', function (Blueprint $table)
                {
                    $table->bigIncrements('product_cart_id');

                    $table->bigInteger('product_id')->unsigned();
                    $table->foreign('product_id')->references('product_id')->on('products');

                    $table->bigInteger('user_id')->unsigned()->nullable()->comment('for loggedin user');
                    $table->foreign('user_id')->references('id')->on('users');

                    $table->integer('product_quantity')->default(1);
                    
                    $table->text('user_device_id')->nullable()->comment('for guest user');

                    $table->tinyInteger('cart_status')->default(1)->comment('1:Active, 2:Inactive');
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
            Schema::dropIfExists('product_carts');
        }

    }
    