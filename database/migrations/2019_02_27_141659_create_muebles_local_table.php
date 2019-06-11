<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMueblesLocalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('muebles_local', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('local_id')->unsigned();
            $table->foreign('local_id')->references('id')->on('locales');
			$table->integer('mueble_id')->unsigned();
            $table->foreign('mueble_id')->references('id')->on('muebles');
			$table->double('precio')->nullable();

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
		Schema::drop('muebles_local');
	}

}
