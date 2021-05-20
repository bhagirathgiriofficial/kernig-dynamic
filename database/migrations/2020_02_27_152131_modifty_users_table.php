<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModiftyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
            $table->dropColumn('zip_code');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->after('state')->nullable();
            $table->foreign('country_id')->references('country_id')->on('countries');
            $table->timestamp('email_verified_at')->nullable()->after('password');
            $table->string('zip_code')->after('country_id')->nullable();
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
