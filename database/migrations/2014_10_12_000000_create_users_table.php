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
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->default('https://res.cloudinary.com/dqelbnq5n/image/upload/v1634481475/default_odqauf.png');
            $table->string('street')->default(' ');
            $table->string('housenumber')->default(' ');
            $table->string('city')->default(' ');
            $table->string('postal')->default(' ');
            $table->string('country')->default(' ');
            $table->string('phone')->default(' ');
            $table->string('bio')->default(' ');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
