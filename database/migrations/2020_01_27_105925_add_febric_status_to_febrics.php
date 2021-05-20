<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFebricStatusToFebrics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('febrics', function (Blueprint $table) {
            $table->boolean('febric_status')->comment(' 1 = Active , 0 = Inactive')->after('febric_name')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('febrics', function (Blueprint $table) {
            //
        });
    }
}
