<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->bigIncrements('measurement_id');
            $table->text('measurement_title');
            $table->float('measurement_price');
            $table->text('measurement_desc');
            $table->text('measurement_chart');
            $table->text('detail_desc')->nullable();
            $table->string('measurement_slug', 255)->default('');
            $table->unsignedBigInteger('measurement_order')->default(0)->nullable();
            $table->boolean('measurement_status')->default(1)->comment('1 = Active , 0 = Inactive');
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
        Schema::dropIfExists('measurements');
    }
}
