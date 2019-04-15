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
    return redirect()->route('home');
});


Auth::routes(['verify' => true]);

Route::get('/noscriptpage', function () {
    return view('noscriptpage');
});

Route::middleware(['auth', 'verified'])->group(function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
	Route::resource('/clientes', 'clientcontoller');
	Route::resource('/sclientes', 'sclientcontroller');
	Route::resource('/generadores', 'genercontroller');
	Route::resource('/sgeneradores', 'sgenercontroller');
	Route::resource('/declaraciones', 'DeclarController');
	Route::resource('/respels', 'RespelController');
	Route::resource('/permisos', 'RolesController');
	Route::resource('/audits', 'auditController');
	Route::resource('/place/departament', 'DepartamentoController');
	Route::resource('/areas','AreaController');
	Route::resource('/place/municipal','municipalityController');
	Route::resource('/cargos','CargoController');
	Route::resource('/personal', 'PersonalController');
	Route::resource('/vehicle','VehicleController');
	Route::resource('/vehicle-programacion','VehicProgController');
	Route::resource('/vehicle-mantenimiento','VehicManteController');
	Route::resource('/tratamiento','TratamientoController');
	Route::resource('/asistencia', 'AssistancesController');
	Route::resource('/compra/orden','OrdenCompraController');
	Route::resource('/compra/cotizacion','QuotationController');
	Route::resource('/activos','ActivoController');
	Route::resource('/movimiento-activos','MovimientoActivoController');
	Route::resource('/capacitacion','TrainingsController');
	Route::resource('/capacitacion-personal','TrainingPersonalsController');
	Route::resource('/inventariotech', 'InventarioTechonologiesController');
	Route::resource('/recibo-material', 'ReciboMaterialController');
	Route::resource('/respel-envios', 'RespelEnviosController');
	Route::resource('/solicitud-residuo', 'SolicitudResiduoController');
	Route::resource('/solicitud-servicio', 'SolicitudServicioController');
	Route::resource('/certificado', 'CertificadoController');
	Route::resource('/manifiesto', 'ManifiestoController');
	Route::resource('/articulos-proveedor', 'ArticuloXProveedorController');
	Route::resource('/code', 'QrCodesController');
	Route::resource('/horario', 'HorarioController');
	Route::resource('/asistencias', 'AsistenciaController');
	Route::resource('/recurso', 'RecursoController');
	Route::resource('/requerimientos', 'RequerimientoController');
	Route::resource('/holidays', 'holidayController');
	Route::resource('/prueba', 'pruebaController');
	Route::resource('/cotizacion', 'CotizacionController');
	Route::resource('/tarifas', 'TarifaController');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/logout', 'Auth\LoginController@logout');
<<<<<<< HEAD
	Route::get('/sclientes/{id}', 'sclientcontroller@getMunicipio');
});
=======
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
>>>>>>> master
