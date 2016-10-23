<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserActivitiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order');
            $table->integer('is_registered');
            $table->date('registrarion_date');
            $table->string('registrated_by');
            $table->integer('persona_id')->unsigned();
            $table->integer('activity_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('activity_id')->references('id')->on('activities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_activities');
    }
}
