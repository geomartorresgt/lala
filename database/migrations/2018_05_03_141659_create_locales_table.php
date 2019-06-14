<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locales', function(Blueprint $table)
		{
            $table->increments('id');
			$table->string('nombre')->nullable();
			$table->text('direccion')->nullable();
			$table->string('telefono_contacto', 45)->nullable();
			$table->text('logo_url')->nullable();

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
		Schema::drop('locales');
	}

}
