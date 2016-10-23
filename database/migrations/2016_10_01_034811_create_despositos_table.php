<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDespositosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despositos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('numeber');
            $table->date('date');
            $table->integer('amount')->unsigned();
            $table->integer('register_number');
            $table->integer('used');
            $table->text('comments');
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
        Schema::drop('despositos');
    }
}
