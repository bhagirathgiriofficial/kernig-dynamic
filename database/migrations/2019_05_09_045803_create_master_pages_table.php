<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateMasterPagesTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('master_pages'))
            {
                Schema::create('master_pages', function (Blueprint $table)
                {
                    $table->bigIncrements('page_id');
                    $table->string('page_name');
                    $table->text('image_name')->nullable();
                    $table->text('page_top_description')->nullable();
                    $table->text('page_small_description')->nullable();
                    $table->text('page_middle_description')->nullable();
                    $table->text('page_meta_title')->nullable();
                    $table->text('page_meta_keyword');
                    $table->text('page_meta_description')->nullable();
                    $table->boolean('page_status')->default(1)->comment('1:Active, 0:Inactive');
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
            Schema::dropIfExists('master_pages');
        }

    }
    