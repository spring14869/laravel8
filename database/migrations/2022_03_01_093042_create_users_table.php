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
            $table->id('u_id');
            $table->string('u_account')->unique();
            $table->string('u_password')->nullable();
            $table->string('u_email')->nullable();
            $table->string('u_name')->nullable();
            $table->string('u_image')->nullable();
            $table->string('u_remark')->nullable();
            $table->tinyInteger('u_status')->default(1);
            $table->rememberToken()->nullable();
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
