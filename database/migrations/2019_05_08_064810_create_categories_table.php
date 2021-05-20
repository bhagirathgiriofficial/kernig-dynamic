<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateCategoriesTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('categories'))
            {
                Schema::create('categories', function (Blueprint $table)
                {
                    $table->bigIncrements('category_id');
                    $table->integer('category_root_id')->unsigned()->default(0);
                    
                    $table->string('city_id', 255)->default('');
                    
                    $table->string('category_name', 255)->default('');
                    $table->string('category_slug', 255)->default('');
                    $table->text('category_image');
                    $table->tinyInteger('category_level')->default(1)->comment('set the category level for catgory, sub-category etc');
                    $table->tinyInteger('category_status')->default(1)->comment('1:Active, 2:Inactive');
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
            Schema::dropIfExists('categories');
        }

    }
    