<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateUsersTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('users'))
            {
                Schema::create('users', function (Blueprint $table)
                {
                    $table->bigIncrements('id');
                    $table->string('f_name')->nullable();
                    $table->string('l_name')->nullable();
                    $table->string('email')->nullable();
                    $table->string('mobile_number')->nullable();
                    $table->text('address')->nullable();
                    $table->string('city')->nullable();
                    $table->string('state')->nullable();
                    $table->timestamp('email_verified_at')->nullable();
                    $table->string('password')->nullable();
                    $table->boolean('user_status')->default(1)->comment('1:Active, 0:Inactive');
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
            Schema::dropIfExists('users');
        }

    }
    