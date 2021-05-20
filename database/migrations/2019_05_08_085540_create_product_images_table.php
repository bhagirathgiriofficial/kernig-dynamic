<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateProductImagesTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('product_images'))
            {
                Schema::create('product_images', function (Blueprint $table)
                {
                    $table->bigIncrements('product_image_id');

                    $table->bigInteger('product_id')->unsigned();
                    $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
                    $table->text('product_image');
                    $table->integer('image_order')->default(0);
                    $table->tinyInteger('image_status')->default(1)->comment('1:Active, 2:Inactive');
                    $table->tinyInteger('default_image')->default(2)->comment('1:Yes, 2:No');
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
            Schema::dropIfExists('product_images');
        }

    }
    