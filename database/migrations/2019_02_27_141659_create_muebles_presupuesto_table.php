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
			$table->integer('presupuesto_id')->unsigned()->nullable();;
            $table->foreign('presupuesto_id')->references('id')->on('presupuestos');
			$table->integer('mueble_id')->unsigned()->nullable();;
            $table->foreign('mueble_id')->references('id')->on('muebles');
			$table->integer('mueble_local_id')->unsigned()->nullable();;
            $table->foreign('mueble_local_id')->references('id')->on('muebles_local');

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
