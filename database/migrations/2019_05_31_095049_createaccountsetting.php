<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createaccountsetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('account_setting'))
            {
                Schema::create('account_setting', function (Blueprint $table)
                {
                    $table->bigIncrements('account_setting_id');
                    $table->string('site_name', 255)->default('');
                    $table->string('site_logo')->default('')->nullable();
                    $table->string('site_number', 255)->default('');
                    $table->text('site_address')->nullable();
                    $table->timestamps();
                });
            }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_setting');
    }
}
