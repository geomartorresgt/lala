<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnLocalIdToPresupuestos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuestos', function (Blueprint $table) {
            $table->integer('local_id')->unsigned()->after('user_id')->nullable();
            $table->foreign('local_id')->references('id')->on('locales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presupuestos', function (Blueprint $table) {
            $table->dropForeign("presupuestos_local_id_foreign");
         	$table->dropColumn('local_id');
        });
    }
}
