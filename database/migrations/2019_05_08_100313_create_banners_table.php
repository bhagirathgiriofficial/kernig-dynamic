<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateBannersTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('banners'))
            {
                Schema::create('banners', function (Blueprint $table)
                {
                    $table->bigIncrements('banner_id');
                    $table->string('banner_name', 255)->default('');
                    $table->text('banner_description')->nullable()->default('');
                    $table->text('banner_image');
                    $table->tinyInteger('banner_type')->default(1)->comment('1:Product, 2:Category');
                    $table->tinyInteger('banner_status')->default(1)->comment('1:Active, 2:Inactive');
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
            Schema::dropIfExists('product_banners');
        }

    }
    