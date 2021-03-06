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

// Route::get('/', function () {
//     return redirect('/login');
// });
Auth::routes();

Route::group(['middleware' => ['auth', "session_time"]], function (){
	Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
		Route::name('root_path')->get('/', 'InicioController@index');
		
		Route::resource('/preguntas-frecuentes', 'PreguntasFrecuentesController', ['parameters' => [
			'preguntas-frecuentes' => 'pregunta_frecuente'
		]]);

		Route::resource('/eventos', 'EventosController');

		Route::resource('/categorias', 'CategoriasController');

		Route::resource('/publicaciones', 'PublicacionesController', ['parameters' => [
			'publicaciones' => 'publicacion'
		]]);

	    Route::group(['prefix' => 'config', 'namespace' => 'Config'], function () {
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

Route::group(['namespace' => 'Web'], function () {
	Route::get('/', 'InicioController@home')->name('root_path');
	Route::get('/conocenos', 'InicioController@conocenos')->name('web.conocenos');
	Route::get('/preguntas-frecuentes', 'PreguntasFrecuentesController@index')->name('web.preguntasFrecuentes.index');
	
	// publicaciones
	Route::get('/noticia/{slug}', 'PublicacionesController@show')->name('web.publicaciones.show');

	// Eventos
	Route::get('/eventos', 'EventosController@index')->name('web.eventos.index');
	Route::get('/evento/{slug}', 'EventosController@show')->name('web.eventos.show');

	// Categorías
	Route::get('/categoria/{slug}', 'CategoriaController@show')->name('web.categoria.show');


});

