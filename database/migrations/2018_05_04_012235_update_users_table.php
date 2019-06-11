<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name','nombres');
            $table->string('apellidos')->after('name');
            $table->string('telefono')->nullable()->after('apellidos');
            $table->boolean('estado')->default(true)->after('password');
            $table->integer('local_id')->unsigned()->nullable()->after('estado')->default(null);
            $table->foreign('local_id')->references('id')->on('locales');
            $table->string('foto_perfil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('nombres','name');
            $table->dropColumn('apellidos');
            $table->dropColumn('telefono');
            $table->dropColumn('estado');
            $table->dropColumn('foto_perfil');
        });
    }
}
