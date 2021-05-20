<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageFlagToMasterPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_pages', function (Blueprint $table) {
            $table->boolean('image_flag')->default(1)->comment("1: Has Image, 0: No Image");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_pages', function (Blueprint $table) {
            //
        });
    }
}
