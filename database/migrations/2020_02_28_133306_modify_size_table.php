<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sizes', function (Blueprint $table) {
            $table->dropColumn('size_measure');
            $table->dropColumn('price_percent');
        });

        Schema::table('sizes', function (Blueprint $table) {
            $table->decimal('size_measure')->after('size_id')->default(0.0);
            $table->decimal('price_percent')->after('size_measure')->default(0.0);
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
