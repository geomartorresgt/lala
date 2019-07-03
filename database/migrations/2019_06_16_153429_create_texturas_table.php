<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTexturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('texturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('archivo')->nullable()->default(null);
            $table->integer('tipo');
            $table->boolean('activo')->default(true);
            
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
        Schema::dropIfExists('texturas');
    }
}
