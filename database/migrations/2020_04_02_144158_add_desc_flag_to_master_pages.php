<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescFlagToMasterPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_pages', function (Blueprint $table) {
            $table->boolean('description_flag')->after('page_status')->comment('0: No need of description, 1: Description needed')->default(0);
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
