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

Route::get('/visor/{gltfFile}', 'visorController@show');

Route::group(['middleware' => ['auth', "session_time"]], function (){
	Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
		Route::name('root_path')->get('/', 'InicioController@index');

		// editor
		Route::resource('/editor', 'EditorController')->only(['index']);
		Route::name('editor.save_image')->post('/editor/save-image', 'EditorController@saveImage');
		Route::name('editor.iframe')->get('/editor-iframe', 'EditorController@iframe');
		Route::get('/editor/muebles', 'EditorController@getMuebles');
		
		// presupuestos
		Route::resource('/presupuestos', 'PresupuestoController');
		Route::post('/presupuestos/{presupuesto}/gltf', 'PresupuestoController@storeGltf');
		Route::get('/mis-presupuestos', 'PresupuestoController@misPresupuestos')->name('presupuestos.misPresupuestos');
		Route::get('/presupuestos/{presupuesto}/edit-diseno', 'PresupuestoController@editDiseno')->name('presupuestos.editDiseno');
		Route::get('/presupuestos/{presupuesto}/reporte', 'PresupuestoController@reporte')->name('presupuestos.reporte');

		Route::resource('/presupuesto/{presupuesto}/presupuesto-mueble', 'PresupuestoMuebleController', [
			'names' => [
				'index' => 'presupuestosMuebles.index',
				'store' => 'presupuestosMuebles.store',
				'create' => 'presupuestosMuebles.create',
				'edit' => 'presupuestosMuebles.edit',
				'show' => 'presupuestosMuebles.show',
				'update' => 'presupuestosMuebles.update',
				'destroy' => 'presupuestosMuebles.destroy',
				
			]
		])->only(['index', 'destroy']);

		Route::resource('/presupuesto/{presupuesto}/capturas-presupuesto', 'CapturaPresupuestoController', [
			'names' => [
				'index' => 'presupuestosCapturas.index',
				'store' => 'presupuestosCapturas.store',
				'destroy' => 'presupuestosCapturas.destroy',
			]
		])->only(['index', 'destroy', 'store']);

		Route::resource('muebles', 'LocalMuebleController', [
			'names' => [
				'index' => 'localMueble.index',
				'store' => 'localMueble.store',
				'create' => 'localMueble.create',
				'edit' => 'localMueble.edit',
				'show' => 'localMueble.show',
				'update' => 'localMueble.update',
				'destroy' => 'localMueble.destroy',
				
			]
		]);
		Route::get('/categorias-muebles/editor', 'LocalMuebleController@editor');

	    Route::group(['prefix' => 'config', 'namespace' => 'Config'], function () {
			Route::resource('/categorias-muebles', 'CategoriaMuebleController');
			Route::resource('muebles', 'MuebleController');
			Route::resource('locales', 'LocalController')->parameters([
				'locales' => 'local'
			]);;


		    Route::resource('/usuarios', 'UsuarioController');
            Route::put('/usuariosSide','UsuarioController@usuariosSide'); // cambiar datos del usuario logueado
            Route::put('/cambiarFoto/{user_id}', 'UsuarioController@cambiarFoto');
			
		    Route::group(['prefix' => 'privilegios', 'namespace' => 'Privilegios'], function () {
				Route::resource('/roles', 'RolController');
		        Route::resource('/permisos', 'PermisoController');
			});
			
			Route::resource('/texturas', 'TexturaController');

			Route::group(['prefix' => 'datos-masivos', 'namespace' => 'DatosMasivos'], function () {
				Route::get('/', 'ExcelController@index')->name('excel.index');
				Route::post('/upload', 'ExcelController@upload')->name('excel.upload');;
				Route::post('/download', 'ExcelController@download')->name('excel.download');;
			});

			
	    });
	});
});