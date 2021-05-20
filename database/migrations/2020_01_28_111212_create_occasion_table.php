<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOccasionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occasions', function (Blueprint $table) {
            $table->bigIncrements('occasion_id');
            $table->text('occasion_name');
            $table->integer('occasion_order')->default(0);
            $table->boolean('occasion_status')->default(1)->comment('1 = Actice , 0 = Inactive');
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
        Schema::dropIfExists('occasion');
    }
}
