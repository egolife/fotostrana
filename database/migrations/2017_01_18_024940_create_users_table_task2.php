<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTableTask2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        CREATE TABLE `users` (
//    `id` int(11) NOT NULL AUTO_INCREMENT,
//    `name` varchar(32) NOT NULL,
//    `gender` tinyint(2) NOT NULL,
//    `email` varchar(1024) NOT NULL,
//    PRIMARY KEY (`id`)
//    ) ENGINE=InnoDB;
        Schema::create('users2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->tinyInteger('gender');
            $table->string('email', 1024);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users2');
    }
}
