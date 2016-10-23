<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIglesiasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iglesias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('pastor');
            $table->text('description');
            $table->string('phone');
            $table->integer('comuna_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('comuna_id')->references('id')->on('comunas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iglesias');
    }
}
