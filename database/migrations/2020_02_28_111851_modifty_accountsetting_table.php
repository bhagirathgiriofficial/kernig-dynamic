<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModiftyAccountsettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_setting', function (Blueprint $table) {
            $table->string('site_email')->default('')->after('site_name');
            $table->string('site_sales_email')->default('')->after('site_email');
            $table->string('facebook_url')->default('')->after('site_address');
            $table->string('twitter_url')->default('')->after('facebook_url');
            $table->string('instagram_url')->default('')->after('twitter_url');
            $table->string('googleplus_url')->default('')->after('instagram_url');
            $table->string('pinterest_url')->default('')->after('googleplus_url');
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
