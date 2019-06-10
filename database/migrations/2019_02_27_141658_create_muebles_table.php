<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMueblesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('muebles', function(Blueprint $table)
		{
            $table->increments('id');
			$table->string('codigo', 45);
			$table->string('nombre', 45);
			$table->string('dimensiones', 45)->nullable();
			$table->string('foto_url')->nullable();
			$table->string('directorio_url')->nullable();
			$table->double('precio')->nullable();
			$table->integer('tipo_mueble')->unsigned()->nullable();
			$table->integer('categoria_mueble_id')->unsigned();
            $table->foreign('categoria_mueble_id')->references('id')->on('categorias_muebles');

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
		Schema::drop('muebles');
	}
}
