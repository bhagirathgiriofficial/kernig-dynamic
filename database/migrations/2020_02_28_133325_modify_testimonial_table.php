<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTestimonialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('testimonials');

        if (!Schema::hasTable('testimonials'))
        {
            Schema::create('testimonials', function (Blueprint $table) {
                $table->bigIncrements('testimonial_id');
                $table->string('testimonial_name');
                $table->text('testimonial_message');
                $table->string('testimonial_place');
                $table->string('testimonial_image'); 
                $table->integer('testimonial_order')->default(0);
                $table->boolean('testimonial_status')->default(0)->comment("1: Active, 0: Inactive");
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
        Schema::dropIfExists('testimonials');
    }
}
