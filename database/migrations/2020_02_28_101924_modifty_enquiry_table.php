<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModiftyEnquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn('enquiry_item_code');
            $table->dropColumn('product_name');
            $table->dropColumn('enquiry_user_name');
        });

        Schema::table('enquiries', function (Blueprint $table) {
            $table->string('enquiry_first_name')->before('enquiry_email')->default('');
            $table->string('enquiry_last_name')->before('enquiry_email')->default('');
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
