<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('product_reviews'))
            {
                Schema::create('product_reviews', function (Blueprint $table)
                {
                    $table->bigIncrements('product_review_id');
                    $table->unsignedBigInteger('product_id');
                    $table->foreign('product_id')->references('product_id')->on('products');
                    $table->string('user_name', 255)->default('');
                    $table->string('user_email', 255)->default('')->nullable();
                    $table->integer('user_rating')->default(0)->nullable();
                    $table->text('review_title')->nullable();
                    $table->text('review_message')->nullable();
                    $table->dateTime('review_date')->nullable();
                    $table->tinyInteger('review_status')->default(1)->comment('1:Not Publised, 2:Publised');
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
        Schema::dropIfExists('product_reviews');
    }
}
