<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCategroiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('city_id');
            $table->dropColumn('hsl_code');
            $table->dropColumn('slug');
            $table->dropColumn('category_level');
            $table->dropColumn('category_image');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('category_image')->after('category_subroot_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
