<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('rut')->unique();
            $table->string('full_name');
            $table->integer('gender');
            $table->date('birthday');
            $table->string('occupation');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->text('description');
            $table->string('facebook');
            $table->string('twitter');
            $table->integer('users_id')->unsigned();
            $table->integer('is_leader');
            $table->integer('iglesias_id')->unsigned();
            $table->integer('comunas_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('iglesias_id')->references('id')->on('iglesias');
            $table->foreign('comunas_id')->references('id')->on('comunas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('personas');
    }
}
