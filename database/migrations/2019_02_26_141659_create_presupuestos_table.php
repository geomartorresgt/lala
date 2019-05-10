<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePresupuestosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('presupuestos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('data_json')->nullable();
			$table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
			$table->string('nombre_cliente', 45)->nullable();
			$table->string('email_cliente', 45)->nullable();
			$table->string('telefono_cliente', 45)->nullable();
			$table->string('cedula_cliente', 45)->nullable();
			$table->timestamp('fecha')->nullable();
			$table->string('descuento', 45)->nullable();

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
		Schema::drop('presupuestos');
	}

}
