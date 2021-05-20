<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateUserWhishListsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('user_whish_lists'))
            {
                Schema::create('user_whish_lists', function (Blueprint $table)
                {
                    $table->bigIncrements('user_whish_list_id');

                    $table->bigInteger('user_id')->unsigned();
                    $table->foreign('user_id')->references('id')->on('users');

                    $table->bigInteger('product_id')->unsigned();
                    $table->foreign('product_id')->references('product_id')->on('products');

                    $table->tinyInteger('whishlist_status')->default(1)->comment('1:Active, 2:Inactive');
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
            Schema::dropIfExists('user_whish_lists');
        }

    }
    