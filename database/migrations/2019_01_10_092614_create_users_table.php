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
        // users用户表
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('员工姓名');
            $table->string('d_id', 100)->comment('部门id');
            $table->unsignedInteger('sex')->default(0)->comment('性别0未知1男2女');
            $table->string('mobile', 100)->comment('手机号');
            $table->softDeletes();
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
