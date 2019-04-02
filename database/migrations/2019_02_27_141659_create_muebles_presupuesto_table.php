<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMueblesPresupuestoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('muebles_presupuesto', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('mueble_local_id')->unsigned();
            $table->foreign('mueble_local_id')->references('id')->on('muebles_local');
            $table->integer('muebles_local')->unsigned();
            $table->foreign('muebles_local')->references('id')->on('presupuestos');

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
		Schema::drop('muebles_presupuesto');
	}

}
