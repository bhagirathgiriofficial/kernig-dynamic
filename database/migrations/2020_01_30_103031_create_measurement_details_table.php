<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurement_details', function (Blueprint $table) {
            $table->bigIncrements('measurement_detail_id');
            $table->bigInteger('measurement_id')->unsigned()->references('measurements')->on('measurement_id');
            $table->text('measurement_title');
            $table->text('title_description');
            $table->boolean('details_status')->default(1)->comment('1 = Active, 0 = Inactive');
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
        Schema::dropIfExists('measurement_details');
    }
}
