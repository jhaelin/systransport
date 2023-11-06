<?php 
 
use App\ModelEmpresa;
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
    return view('auth.login')->with('e',ModelEmpresa::emp());
    //return view('auth.login')->with('e',ModelEmpresa::emp());
});

// Route::get('/login', 'Auth\AuthController@getLogin');//login 
// Route::post('/login', 'Auth\AuthController@postLogin');//validar 
// Route::get('/logout', 'Auth\AuthController@getLogout')->after('invalidate-browser-cache');

Route::get('/login', function () {
	return view('auth.login')->with('e',ModelEmpresa::emp());
	// $e=ModelEmpresa::emp();
	// \Session::flash('e',$e);
 //    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');   

Route::get('admin', function () {
    return view('adminlte.home');
});

Route::resource('usuario', 'UsuarioController');
Route::post('valpersonjq', 'UsuarioController@valpersonjq');
Route::post('valcuentajq', 'UsuarioController@valcuentajq');
Route::get('deleteU/{id}', 'UsuarioController@deleteU');
Route::post('/deletU', 'UsuarioController@deletU');

Route::post('actpassw', 'UsuarioController@actpassw');
Route::post('UpdatePass', 'UsuarioController@UpdatePass');
Route::post('UpdateFoto', 'UsuarioController@UpdateFoto');

//--- 
// Route::resource('cargo', 'CargoController');
// Route::get('deleteCargo/{id}', 'CargoController@delete');
// Route::post('/deletCargo', 'CargoController@delet');

Route::resource('persona', 'PersonaController');
Route::get('deletePersona/{id}', 'PersonaController@delete'); 
Route::post('/deletPersona', 'PersonaController@delet');

// Route::resource('asigperson', 'AsigPersonaController');
// Route::get('deleteAsigPerson/{id}', 'AsigPersonaController@delete'); 
// Route::post('/deletAsigPerson', 'AsigPersonaController@delet');

Route::resource('cliente', 'ClienteController');
Route::get('deleteCliente/{id}', 'ClienteController@delete');
Route::post('/deletCliente', 'ClienteController@delet');

Route::resource('conductor', 'ConductorController');
Route::get('deleteConductor/{id}', 'ConductorController@delete');
Route::post('/deletConductor', 'ConductorController@delet');

Route::resource('camion', 'CamionController');
Route::get('deleteCamion/{id}', 'CamionController@delete');
Route::post('/deletCamion', 'CamionController@delet');

Route::resource('ruta', 'RutaController');
Route::get('deleteRuta/{id}', 'RutaController@delete');
Route::post('/deletRuta', 'RutaController@delet');
//--

Route::resource('flete', 'AdminFleteCamionController');
Route::get('deleteAdminFleteCamion/{id}', 'AdminFleteCamionController@delete');
Route::post('/deletAdminFleteCamion', 'AdminFleteCamionController@delet');

Route::resource('mantenimiento', 'MantenimientoCamionController');
Route::get('deleteMantenientoCamion/{id}', 'MantenimientoCamionController@delete');
Route::post('/deletMantenientoCamion', 'MantenimientoCamionController@delet');
Route::get('modalAddMantenientoCamion/{idm}', 'MantenimientoCamionController@modalAdd');
Route::post('/addMantenientoCamion', 'MantenimientoCamionController@add');

Route::resource('ingreso', 'IngresoController');
Route::get('deleteIngreso/{id}', 'IngresoController@delete');
Route::post('/deletIngreso', 'IngresoController@delet');
Route::post('ingresoFletejs', 'IngresoController@ingresoFletejs');
Route::post('ingresoFlete2js', 'IngresoController@ingresoFlete2js');
Route::post('ingresoFlete3js', 'IngresoController@ingresoFlete3js');

Route::resource('egreso', 'EgresoController');
Route::get('deleteEgreso/{id}', 'EgresoController@delete');
Route::post('/deletEgreso', 'EgresoController@delet');

// REPORTE VISTA
Route::get('repUsuario', 'ReporteUsuarioController@repUsuario');
Route::post('repUsjq', 'ReporteUsuarioController@repUsjq');

Route::get('repCamion', 'ReporteCamCliConController@repCamion');
Route::post('repCamjq', 'ReporteCamCliConController@repCamjq');

Route::get('repCliente', 'ReporteCamCliConController@repCliente');
Route::post('repClijq', 'ReporteCamCliConController@repClijq');

Route::get('repConductor', 'ReporteCamCliConController@repConductor');
Route::post('repConjq', 'ReporteCamCliConController@repConjq');

Route::get('repFlete', 'ReporteFleteController@repFlete');
Route::post('repFlejq', 'ReporteFleteController@repFlejq');
Route::post('repFle1jq', 'ReporteFleteController@repFle1jq');

Route::get('repHistMantenimiento', 'ReporteMantenimientoController@repHistMantenimiento');
Route::post('repHisManjq', 'ReporteMantenimientoController@repHisManjq');

Route::get('repMantenimiento', 'ReporteMantenimientoController@repMantenimiento');
Route::post('repManjq', 'ReporteMantenimientoController@repManjq');


Route::get('repEgreso', 'ReporteIngresoEgresoController@repEgreso');
Route::post('repEgjq', 'ReporteIngresoEgresoController@repEgjq');

Route::get('repIngreso', 'ReporteIngresoEgresoController@repIngreso');
Route::post('repIngjq', 'ReporteIngresoEgresoController@repIngjq');

Route::get('repImpuesto', 'ReporteIngresoEgresoController@repImpuesto');
Route::post('repImpjq', 'ReporteIngresoEgresoController@repImpjq');

// REPORTE PDF
Route::get('usuarioPdf', 'FpdfReporteController@usuarioPdf');
Route::get('camionPdf', 'FpdfReporteController@camionPdf');
Route::get('clientePdf', 'FpdfReporteController@clientePdf');
Route::get('conductorPdf', 'FpdfReporteController@conductorPdf');
Route::get('fletePdf', 'FpdfReporteController@fletePdf');
Route::get('histmantenimientoPdf', 'FpdfReporteController@histmantenimientoPdf');
Route::get('mantenimientoPdf', 'FpdfReporteController@mantenimientoPdf');
Route::get('ingresoPdf', 'FpdfReporteController@ingresoPdf');
Route::get('egresoPdf', 'FpdfReporteController@egresoPdf');
Route::get('impuestoPdf', 'FpdfReporteController@impuestoPdf');
