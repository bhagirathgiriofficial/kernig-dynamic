<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateApiTokensTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('api_tokens'))
            {
                Schema::create('api_tokens', function (Blueprint $table)
                {
                    $table->bigIncrements('api_token_id');
                    $table->bigInteger('user_id')->unsigned();
                    $table->foreign('user_id')->references('id')->on('users');
                    $table->text('api_token');
                    $table->tinyInteger('token_status')->default(1)->comment('1:Active, 2:Inactive');
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
            Schema::dropIfExists('api_tokens');
        }

    }
    