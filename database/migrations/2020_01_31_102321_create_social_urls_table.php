<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_urls', function (Blueprint $table) {
            $table->bigIncrements('social_url_id');
            $table->string('social_url_title')->unique();
            $table->text('social_url_link');
            $table->boolean('social_url_status')->default(1)->comment('1 = Active , 0 = Inactive');
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
        Schema::dropIfExists('social_urls');
    }
}
