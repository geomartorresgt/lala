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

		// editor
		Route::resource('/editor', 'EditorController')->only(['index']);
		Route::name('editor.save_image')->post('/editor/save-image', 'EditorController@saveImage');
		Route::name('editor.iframe')->get('/editor-iframe', 'EditorController@iframe');
		Route::get('/editor/muebles', 'EditorController@getMuebles');		

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