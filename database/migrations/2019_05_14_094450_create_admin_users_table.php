<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateAdminUsersTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('admin_users'))
            {
                Schema::create('admin_users', function (Blueprint $table)
                {
                    $table->bigIncrements('id');
                    $table->string('name')->nullable();
                    $table->string('email')->unique();
                    $table->string('mobile_number')->nullable();
                    $table->timestamp('email_verified_at')->nullable();
                    $table->text('profile_image')->nullable();
                    $table->string('password')->nullable();
                    $table->tinyInteger('user_status')->default(1)->comment('1:Active, 2:Inactive');
                    $table->rememberToken();
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
            Schema::dropIfExists('admin_users');
        }

    }
    