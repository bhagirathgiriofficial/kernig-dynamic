<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGallaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallary', function (Blueprint $table) {
            $table->bigIncrements('image_id');
            $table->text('image_title')->comment('Used As Alt text also');
            $table->text('gallary_image')->nullable();
            $table->text('image_desc')->nullable();
            $table->integer('gallary_order')->default(0)->nullable();
            $table->boolean('image_status')->comment('0 = Inactive, 1 = Active')->default(1);
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
        Schema::dropIfExists('gallary');
    }
}
