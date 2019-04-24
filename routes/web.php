<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});
Auth::routes();

Route::group(['middleware' => ['auth', "session_time"]], function (){
	Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
		Route::name('root_path')->get('/', 'InicioController@index');

		Route::get('/editor', function(){
        	return view('admin.editor.index');
		})->name('editor.index');

	    Route::group(['prefix' => 'config', 'namespace' => 'Config'], function () {
			Route::resource('/categorias-muebles', 'CategoriaMuebleController');
			Route::resource('muebles', 'MuebleController');
			

		    Route::resource('/usuarios', 'UsuarioController');
            Route::put('/usuariosSide','UsuarioController@usuariosSide'); // cambiar datos del usuario logueado
            Route::put('/cambiarFoto/{user_id}', 'UsuarioController@cambiarFoto');

		    Route::group(['prefix' => 'privilegios', 'namespace' => 'Privilegios'], function () {
		        Route::resource('/roles', 'RolController');
		        Route::resource('/permisos', 'PermisoController');
		    });
	    });
	});
});