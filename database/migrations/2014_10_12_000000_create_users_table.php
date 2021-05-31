<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id_ref')->default(0);
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->bigInteger('type')->default(0);
            $table->string('avatar')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_user_id')->nullable();
            $table->string('ip')->nullable();
            $table->string('country')->nullable();
            $table->string('device')->nullable();
            $table->text('api_token')->nullable();
            $table->bigInteger('status')->default(1);
            $table->dateTime('last_active')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
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
