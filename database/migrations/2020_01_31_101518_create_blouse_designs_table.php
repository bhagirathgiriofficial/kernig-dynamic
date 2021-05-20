<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlouseDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blouse_designs', function (Blueprint $table) {
            $table->bigIncrements('blouse_design_id');
            $table->string('blouse_design_name', 100)->comment('Also used as Alt text');
            $table->text('blouse_design_image');
            $table->integer('blouse_design_order')->default(0);
            $table->boolean('blouse_design_status')->default(1)->comment('1 = Active,  0  = Inactive');
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
        Schema::dropIfExists('blouse_designs');
    }
}
