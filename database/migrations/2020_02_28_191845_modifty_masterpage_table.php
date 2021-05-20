<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModiftyMasterpageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_pages', function (Blueprint $table) {
            $table->dropColumn('page_top_description');
            $table->dropColumn('page_small_description');
            $table->dropColumn('page_middle_description');
        });

        Schema::table('master_pages', function (Blueprint $table) {
            $table->string('page_slug')->after('page_name')->default('');
            $table->text('page_short_description')->after('page_slug')->nullable();
            $table->text('page_long_description')->after('page_short_description')->nullable();
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
