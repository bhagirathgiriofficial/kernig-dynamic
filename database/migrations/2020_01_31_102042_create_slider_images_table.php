<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_images', function (Blueprint $table) {
            $table->bigIncrements('slider_id');
            $table->text('slider_title')->comment('aslo used as ALT text');
            $table->text('slider_image')->nullable();;
            $table->text('slider_link')->nullable();
            $table->boolean('slider_status')->default(1)->comment('1 = Active , 0 = Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider_images');
    }
}
