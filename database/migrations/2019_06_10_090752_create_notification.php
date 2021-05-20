<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('notifications'))
        {
            Schema::create('notifications', function (Blueprint $table)
            {
                $table->bigIncrements('notification_id');
                $table->bigInteger('user_id')->default(0);
                $table->bigInteger('product_id')->default(0);
                $table->bigInteger('product_order_id')->default(0);
                $table->bigInteger('notification_type')->comment('1:Top Deals, 2:Order Placed, 3:Order Completed, 4:Order Cancelled, 5:Order Failed, 6:Order Return');
                $table->text('notification_text');
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
        Schema::dropIfExists('notification');
    }
}
