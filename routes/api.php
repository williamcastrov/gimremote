<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas definidas para los Parametros del Sistema
Route::get('/paises/listar_paises', 'App\Http\Controllers\API\Parameters\PaisesController@listar_paises');
Route::post('/paises/create', 'App\Http\Controllers\API\Parameters\PaisesController@create');
Route::get('/paises/get/{id}', 'App\Http\Controllers\API\Parameters\PaisesController@get');
Route::delete('/paises/delete/{id}', 'App\Http\Controllers\API\Parameters\PaisesController@delete');
Route::put('/paises/update/{id}', 'App\Http\Controllers\API\Parameters\PaisesController@update');

Route::get('/regiones/listar_regiones', 'App\Http\Controllers\API\Parameters\RegionesController@listar_regiones');
Route::post('/regiones/create', 'App\Http\Controllers\API\Parameters\RegionesController@create');
Route::get('/regiones/get/{id}', 'App\Http\Controllers\API\Parameters\RegionesController@get');
Route::delete('/regiones/delete/{id}', 'App\Http\Controllers\API\Parameters\RegionesController@delete');
Route::put('/regiones/update/{id}', 'App\Http\Controllers\API\Parameters\RegionesController@update');

Route::get('/departamentos/listar_departamentos', 'App\Http\Controllers\API\Parameters\DepartamentosController@listar_departamentos');
Route::post('/departamentos/create', 'App\Http\Controllers\API\Parameters\DepartamentosController@create');
Route::get('/departamentos/get/{id}', 'App\Http\Controllers\API\Parameters\DepartamentosController@get');
Route::delete('/departamentos/delete/{id}', 'App\Http\Controllers\API\Parameters\DepartamentosController@delete');
Route::put('/departamentos/update/{id}', 'App\Http\Controllers\API\Parameters\DepartamentosController@update');

Route::get('/ciudades/listar_ciudades', 'App\Http\Controllers\API\Parameters\CiudadesController@listar_ciudades');
Route::post('/ciudades/create', 'App\Http\Controllers\API\Parameters\CiudadesController@create');
Route::get('/ciudades/get/{id}', 'App\Http\Controllers\API\Parameters\CiudadesController@get');
Route::delete('/ciudades/delete/{id}', 'App\Http\Controllers\API\Parameters\CiudadesController@delete');
Route::put('/ciudades/update/{id}', 'App\Http\Controllers\API\Parameters\CiudadesController@update');

Route::get('/unidades/listar_unidades', 'App\Http\Controllers\API\Parameters\UnidadesController@listar_unidades');
Route::get('/unidades/listar_tipopartes', 'App\Http\Controllers\API\Parameters\UnidadesController@listar_tipopartes');
Route::get('/unidades/listar_tipoequipos', 'App\Http\Controllers\API\Parameters\UnidadesController@listar_tipoequipos');
Route::get('/unidades/listar_tipousuarios', 'App\Http\Controllers\API\Parameters\UnidadesController@listar_tipousuarios');
Route::post('/unidades/create', 'App\Http\Controllers\API\Parameters\UnidadesController@create');
Route::get('/unidades/get/{id}', 'App\Http\Controllers\API\Parameters\UnidadesController@get');
Route::delete('/unidades/delete/{id}', 'App\Http\Controllers\API\Parameters\UnidadesController@delete');
Route::put('/unidades/update/{id}', 'App\Http\Controllers\API\Parameters\UnidadesController@update');

Route::get('/estados/listar_estados', 'App\Http\Controllers\API\Parameters\EstadosController@listar_estados');
Route::get('/estados/listar_estadosgenerales', 'App\Http\Controllers\API\Parameters\EstadosController@listar_estadosgenerales');
Route::get('/estados/listar_estadospendientes', 'App\Http\Controllers\API\Parameters\EstadosController@listar_estadospendientes');
Route::get('/estados/listar_estadosOT', 'App\Http\Controllers\API\Parameters\EstadosController@listar_estadosOT');
Route::get('/estados/listar_estadoscontratos', 'App\Http\Controllers\API\Parameters\EstadosController@listar_estadoscontratos');
Route::get('/estados/listar_estadosseguros', 'App\Http\Controllers\API\Parameters\EstadosController@listar_estadosseguros');
Route::get('/estados/listar_estadosequipos', 'App\Http\Controllers\API\Parameters\EstadosController@listar_estadosequipos');
Route::get('/estados/listar_estadosequipooperacion', 'App\Http\Controllers\API\Parameters\EstadosController@listar_estadosequipooperacion');
Route::post('/estados/create', 'App\Http\Controllers\API\Parameters\EstadosController@create');
Route::get('/estados/get/{id}', 'App\Http\Controllers\API\Parameters\EstadosController@get');
Route::delete('/estados/delete/{id}', 'App\Http\Controllers\API\Parameters\EstadosController@delete');
Route::put('/estados/update/{id}', 'App\Http\Controllers\API\Parameters\EstadosController@update');

Route::get('/monedas/listar_monedas', 'App\Http\Controllers\API\Parameters\MonedasController@listar_monedas');
Route::post('/monedas/create', 'App\Http\Controllers\API\Parameters\MonedasController@create');
Route::get('/monedas/get/{id}', 'App\Http\Controllers\API\Parameters\MonedasController@get');
Route::delete('/monedas/delete/{id}', 'App\Http\Controllers\API\Parameters\MonedasController@delete');
Route::put('/monedas/update/{id}', 'App\Http\Controllers\API\Parameters\MonedasController@update');

Route::get('/empresa/listar_empresa', 'App\Http\Controllers\API\Parameters\EmpresaController@listar_empresa');
Route::post('/empresa/create', 'App\Http\Controllers\API\Parameters\EmpresaController@create');
Route::get('/empresa/get/{id}', 'App\Http\Controllers\API\Parameters\EmpresaController@get');
Route::delete('/empresa/delete/{id}', 'App\Http\Controllers\API\Parameters\EmpresaController@delete');
Route::put('/empresa/update/{id}', 'App\Http\Controllers\API\Parameters\EmpresaController@update');

// Rutas Gestión Usuarios
Route::get('/usuarios/listar_usuarios', 'App\Http\Controllers\API\UsuariosController@listar_usuarios');
Route::get('/usuarios/leer_usuario/{id}', 'App\Http\Controllers\API\UsuariosController@leer_usuario');
Route::post('/usuarios/create', 'App\Http\Controllers\API\UsuariosController@create');
Route::get('/usuarios/get/{id}', 'App\Http\Controllers\API\UsuariosController@get');
Route::put('/usuarios/update/{id}', 'App\Http\Controllers\API\UsuariosController@update');
Route::delete('/usuarios/delete/{id}', 'App\Http\Controllers\API\UsuariosController@delete');

Route::get('/dashboard/listar_dashboard', 'App\Http\Controllers\API\DashboardController@listar_dashboard');

// Rutas Gestión Interlocutores
Route::get('/tipointerlocutor/listar_tipointerlocutor', 'App\Http\Controllers\API\Interlocutores\TipoInterlocutoresController@listar_tipointerlocutor');
Route::post('/tipointerlocutor/create', 'App\Http\Controllers\API\Interlocutores\TipoInterlocutoresController@create');
Route::get('/tipointerlocutor/get/{id}', 'App\Http\Controllers\API\v\TipoInterlocutoresController@get');
Route::delete('/tipointerlocutor/delete/{id}', 'App\Http\Controllers\API\Interlocutores\TipoInterlocutoresController@delete');
Route::put('/tipointerlocutor/update/{id}', 'App\Http\Controllers\API\Interlocutores\TipoInterlocutoresController@update');

Route::get('/especialidad/listar_especialidades', 'App\Http\Controllers\API\Interlocutores\EspecialidadesController@listar_especialidades');
Route::post('/especialidad/create', 'App\Http\Controllers\API\Interlocutores\EspecialidadesController@create');
Route::get('/especialidad/get/{id}', 'App\Http\Controllers\API\Interlocutores\EspecialidadesController@get');
Route::delete('/especialidad/delete/{id}', 'App\Http\Controllers\API\Interlocutores\EspecialidadesController@delete');
Route::put('/especialidad/update/{id}', 'App\Http\Controllers\API\Interlocutores\EspecialidadesController@update');

Route::get('/proveedores/listar_proveedores', 'App\Http\Controllers\API\Interlocutores\ProveedoresController@listar_proveedores');
Route::get('proveedores/listar_prestadoresservmtto', 'App\Http\Controllers\API\Interlocutores\ProveedoresController@listar_prestadoresservmtto');
Route::post('/proveedores/create', 'App\Http\Controllers\API\Interlocutores\ProveedoresController@create');
Route::get('/proveedores/get/{id}', 'App\Http\Controllers\API\Interlocutores\ProveedoresController@get');
Route::delete('/proveedores/delete/{id}', 'App\Http\Controllers\API\Interlocutores\ProveedoresController@delete');
Route::put('/proveedores/update/{id}', 'App\Http\Controllers\API\Interlocutores\ProveedoresController@update');

Route::get('/clientes/listar_clientes', 'App\Http\Controllers\API\Interlocutores\ClientesController@listar_clientes');
Route::post('/clientes/create', 'App\Http\Controllers\API\Interlocutores\ClientesController@create');
Route::get('/clientes/get/{id}', 'App\Http\Controllers\API\Interlocutores\ClientesController@get');
Route::delete('/clientes/delete/{id}', 'App\Http\Controllers\API\Interlocutores\ClientesController@delete');
Route::put('/clientes/update/{id}', 'App\Http\Controllers\API\Interlocutores\ClientesController@update');

Route::get('/empleados/listar_empleados', 'App\Http\Controllers\API\Interlocutores\EmpleadosController@listar_empleados');
Route::get('/empleados/listar_empleadosOT', 'App\Http\Controllers\API\Interlocutores\EmpleadosController@listar_empleadosOT');
Route::get('/empleados/listar_empleadoscomercial', 'App\Http\Controllers\API\Interlocutores\EmpleadosController@listar_empleadoscomercial');
Route::post('/empleados/create', 'App\Http\Controllers\API\Interlocutores\EmpleadosController@create');
Route::get('/empleados/get/{id}', 'App\Http\Controllers\API\Interlocutores\EmpleadosController@get');
Route::delete('/empleados/delete/{id}', 'App\Http\Controllers\API\Interlocutores\EmpleadosController@delete');
Route::put('/empleados/update/{id}', 'App\Http\Controllers\API\Interlocutores\EmpleadosController@update');

Route::get('/contactos/listar_contactos', 'App\Http\Controllers\API\Interlocutores\ContactosController@listar_contactos');
Route::post('/contactos/create', 'App\Http\Controllers\API\Interlocutores\ContactosController@create');
Route::get('/contactos/get/{id}', 'App\Http\Controllers\API\Interlocutores\ContactosController@get');
Route::get('/contactos/contactosinterlocutor/{id}', 'App\Http\Controllers\API\Interlocutores\ContactosController@contactosinterlocutor');
Route::delete('/contactos/delete/{id}', 'App\Http\Controllers\API\Interlocutores\ContactosController@delete');
Route::put('/contactos/update/{id}', 'App\Http\Controllers\API\Interlocutores\ContactosController@update');

Route::get('/ordenesserv/listar_ordenesserv', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesserv');
Route::get('/ordenesserv/listar_ordenesservusuario', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesservusuario');
Route::get('/ordenesserv/listar_listarot', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_listarot');

Route::get('/ordenesserv/generarPdf/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@generarPdf');
Route::get('/mantenimiento/generarPdfAlza/{id}', 'App\Http\Controllers\API\Mantenimiento\IncrementoCanonController@generarPdfAlza');

Route::get('/ordenesserv/listar_ordenesservactivas', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesservactivas');
Route::get('/ordenesserv/listar_ordenesservactivasusuario', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesservactivasusuario');
Route::get('/ordenesserv/totalotactivas', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@totalotactivas');
Route::get('/ordenesserv/totalotprogramadas', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@totalotprogramadas');
Route::get('/ordenesserv/totalotrevision', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@totalotrevision');
Route::get('/ordenesserv/totalotmes', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@totalotmes');
Route::get('/ordenesserv/totalotterminadasmes', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@totalotterminadasmes');
Route::get('/ordenesserv/cumplimientotalotmes/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@cumplimientotalotmes');
Route::get('/ordenesserv/cumplimientootterminadasmes/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@cumplimientootterminadasmes');
Route::get('/ordenesserv/listar_ordenesservactivasrevision', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesservactivasrevision');
Route::get('/ordenesserv/listar_ordenesservactivasrevisionusuario', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesservactivasrevisionusuario');

Route::get('/ordenesserv/listar_ordeneschequeo', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordeneschequeo');
Route::get('/ordenesserv/listar_ordeneschequeoactivas', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordeneschequeoactivas');
Route::post('/ordenesserv/create', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@create');
Route::get('/ordenesserv/get/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@get');
Route::get('/ordenesserv/leeordentecnico/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@leeordentecnico');
Route::get('/ordenesserv/leetodasordentecnico/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@leetodasordentecnico');
Route::delete('/ordenesserv/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@delete');
Route::put('/ordenesserv/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@update');
Route::put('/ordenesserv/cancelar/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@cancelar');
Route::put('/ordenesserv/ordenprogramada/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@ordenprogramada');
Route::put('/ordenesserv/pasararevision/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@pasararevision');
Route::put('/ordenesserv/sumartiempoactividades/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@sumartiempoactividades');
Route::put('/ordenesserv/cerrarOT/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@cerrarOT');
Route::put('/ordenesserv/updateestadoasignado/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@updateestadoasignado');

Route::get('/cumplimiento/listar_cumplimiento', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@listar_cumplimiento');
Route::post('/cumplimiento/create', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@create');
Route::get('/cumplimiento/get/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@get');
Route::get('/cumplimiento/listaractividadactiva/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@listaractividadactiva');
Route::get('/cumplimiento/getoser/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@getoser');
Route::delete('/cumplimiento/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@delete');
Route::put('/cumplimiento/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@update');
Route::get('/cumplimiento/leeactividadestecnico/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@leeactividadestecnico');
Route::get('/cumplimiento/leetodasactividadestecnico/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@leetodasactividadestecnico');
Route::get('/cumplimiento/leeactividadestotalactivas', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@leeactividadestotalactivas');

// Rutas Gestión Ordenes de Servicio
Route::get('/firmarot/listar_firmasOT/{id}', 'App\Http\Controllers\API\GestionOrdenes\FirmarOTController@listar_firmasOT');
Route::post('/firmarot/create', 'App\Http\Controllers\API\GestionOrdenes\FirmarOTController@create');
Route::delete('/firmarot/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\FirmarOTController@delete');
Route::put('/firmarot/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\FirmarOTController@update');

Route::get('/calificacionservicio/listar_calificacionservcioot', 'App\Http\Controllers\API\GestionOrdenes\CalificacionServicioOTController@listar_calificacionservcioot');
Route::post('/calificacionservicio/create', 'App\Http\Controllers\API\GestionOrdenes\CalificacionServicioOTController@create');
Route::get('/calificacionservicio/get/{id}', 'App\Http\Controllers\API\GestionOrdenes\CalificacionServicioOTController@get');
Route::delete('/calificacionservicio/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\CalificacionServicioOTController@delete');
Route::put('/calificacionservicio/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\CalificacionServicioOTController@update');

Route::get('/imagenesot/listar_imagenesot/{id}', 'App\Http\Controllers\API\GestionOrdenes\ImagenesOrdenesController@listar_imagenesot');
Route::post('/imagenesot/create', 'App\Http\Controllers\API\GestionOrdenes\ImagenesOrdenesController@create');
Route::delete('/imagenesot/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\ImagenesOrdenesController@delete');
Route::put('/imagenesot/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\ImagenesOrdenesController@update');

Route::get('/tiposmtto/listar_tiposmtto', 'App\Http\Controllers\API\Mantenimiento\TiposmttoController@listar_tiposmtto');
Route::get('/tiposmtto/listar_tiposmttoOT', 'App\Http\Controllers\API\Mantenimiento\TiposmttoController@listar_tiposmttoOT');
Route::get('/tiposmtto/listar_tiposmttoalistamiento', 'App\Http\Controllers\API\Mantenimiento\TiposmttoController@listar_tiposmttoalistamiento');
Route::post('/tiposmtto/create', 'App\Http\Controllers\API\Mantenimiento\TiposmttoController@create');
Route::get('/tiposmtto/get/{id}', 'App\Http\Controllers\API\Mantenimiento\TiposmttoController@get');
Route::delete('/tiposmtto/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\TiposmttoController@delete');
Route::put('/tiposmtto/update/{id}', 'App\Http\Controllers\API\Mantenimiento\TiposmttoController@update');

Route::get('/tiposestados/listar_tiposestados', 'App\Http\Controllers\API\GestionOrdenes\TiposEstadosController@listar_tiposestados');
Route::post('/tiposestados/create', 'App\Http\Controllers\API\GestionOrdenes\TiposEstadosController@create');
Route::get('/tiposestados/get/{id}', 'App\Http\Controllers\API\GestionOrdenes\TiposEstadosController@get');
Route::delete('/tiposestados/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\TiposEstadosController@delete');
Route::put('/tiposestados/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\TiposEstadosController@update');

Route::get('/tipooperacion/listar_tipooperacion', 'App\Http\Controllers\API\GestionOrdenes\TipoOperacionController@listar_tipooperacion');
Route::get('/tipooperacion/listar_tipooperacionestados', 'App\Http\Controllers\API\GestionOrdenes\TipoOperacionController@listar_tipooperacionestados');
Route::get('/tipooperacion/listar_tipooperacionchequeo', 'App\Http\Controllers\API\GestionOrdenes\TipoOperacionController@listar_tipooperacionchequeo');
Route::post('/tipooperacion/create', 'App\Http\Controllers\API\GestionOrdenes\TipoOperacionController@create');
Route::get('/tipooperacion/get/{id}', 'App\Http\Controllers\API\GestionOrdenes\TipoOperacionController@get');
Route::delete('/tipooperacion/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\TipoOperacionController@delete');
Route::put('/tipooperacion/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\TipoOperacionController@update');

Route::get('/actividadrealizada/listar_actividadrealizada', 'App\Http\Controllers\API\GestionOrdenes\ActividadRealizadaController@listar_actividadrealizada');
Route::post('/actividadrealizada/create', 'App\Http\Controllers\API\GestionOrdenes\ActividadRealizadaController@create');
Route::get('/actividadrealizada/get/{id}', 'App\Http\Controllers\API\GestionOrdenes\ActividadRealizadaController@get');
Route::delete('/actividadrealizada/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\ActividadRealizadaController@delete');
Route::put('/actividadrealizada/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\ActividadRealizadaController@update');

Route::get('/tiposservicio/listar_tiposservicio', 'App\Http\Controllers\API\GestionOrdenes\TiposServicioController@listar_tiposservicio');
Route::post('/tiposservicio/create', 'App\Http\Controllers\API\GestionOrdenes\TiposServicioController@create');
Route::get('/tiposservicio/get/{id}', 'App\Http\Controllers\API\GestionOrdenes\TiposServicioController@get');
Route::delete('/tiposservicio/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\TiposServicioController@delete');
Route::put('/tiposservicio/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\TiposServicioController@update');

Route::get('/ordenesserv/listar_ordenesserv', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesserv');
Route::get('/ordenesserv/listar_ordenesservusuario', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesservusuario');
Route::get('/ordenesserv/listar_listarot', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_listarot');

Route::get('/ordenesserv/generarPdf/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@generarPdf');
Route::get('/mantenimiento/generarPdfAlza/{id}', 'App\Http\Controllers\API\Mantenimiento\IncrementoCanonController@generarPdfAlza');

Route::get('/ordenesserv/listar_ordenesservactivas', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesservactivas');
Route::get('/ordenesserv/listar_ordenesservactivasusuario', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesservactivasusuario');
Route::get('/ordenesserv/totalotactivas', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@totalotactivas');
Route::get('/ordenesserv/totalotprogramadas', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@totalotprogramadas');
Route::get('/ordenesserv/totalotrevision', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@totalotrevision');
Route::get('/ordenesserv/totalotmes', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@totalotmes');
Route::get('/ordenesserv/totalotterminadasmes', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@totalotterminadasmes');
Route::get('/ordenesserv/cumplimientotalotmes/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@cumplimientotalotmes');
Route::get('/ordenesserv/cumplimientootterminadasmes/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@cumplimientootterminadasmes');
Route::get('/ordenesserv/listar_ordenesservactivasrevision', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesservactivasrevision');
Route::get('/ordenesserv/listar_ordenesservactivasrevisionusuario', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordenesservactivasrevisionusuario');

Route::get('/ordenesserv/listar_ordeneschequeo', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordeneschequeo');
Route::get('/ordenesserv/listar_ordeneschequeoactivas', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@listar_ordeneschequeoactivas');
Route::post('/ordenesserv/create', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@create');
Route::get('/ordenesserv/get/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@get');
Route::get('/ordenesserv/leeordentecnico/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@leeordentecnico');
Route::get('/ordenesserv/leetodasordentecnico/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@leetodasordentecnico');
Route::delete('/ordenesserv/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@delete');
Route::put('/ordenesserv/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@update');
Route::put('/ordenesserv/cancelar/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@cancelar');
Route::put('/ordenesserv/ordenprogramada/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@ordenprogramada');
Route::put('/ordenesserv/pasararevision/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@pasararevision');
Route::put('/ordenesserv/sumartiempoactividades/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@sumartiempoactividades');
Route::put('/ordenesserv/cerrarOT/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@cerrarOT');
Route::put('/ordenesserv/updateestadoasignado/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@updateestadoasignado');
Route::put('/ordenesserv/actualizafinaltransporte/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@actualizafinaltransporte');
Route::put('/ordenesserv/actualizainiciatransporte/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@actualizainiciatransporte');
Route::put('/ordenesserv/actualizatiempoparoot/{id}', 'App\Http\Controllers\API\GestionOrdenes\OrdenesController@actualizatiempoparoot');

Route::get('/cumplimiento/listar_cumplimiento', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@listar_cumplimiento');
Route::post('/cumplimiento/create', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@create');
Route::get('/cumplimiento/get/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@get');
Route::get('/cumplimiento/getoser/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@getoser');
Route::delete('/cumplimiento/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@delete');
Route::put('/cumplimiento/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@update');
Route::put('/cumplimiento/updatehorometro/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@updatehorometro');
Route::put('/cumplimiento/actualizafinaltransporte/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@actualizafinaltransporte');
Route::put('/cumplimiento/actualizainiciatransporte/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@actualizainiciatransporte');
Route::put('/cumplimiento/pasararevision/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@pasararevision');
Route::put('/cumplimiento/cerrarActividad/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@cerrarActividad');
Route::get('/cumplimiento/actividadesactivasxot/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@actividadesactivasxot');
Route::get('/cumplimiento/actividadestotalesxot/{id}', 'App\Http\Controllers\API\GestionOrdenes\CumplimientoOServController@actividadestotalesxot');

Route::get('/pendienteot/listar_pendienteOT/{id}', 'App\Http\Controllers\API\GestionOrdenes\PendienteOTController@listar_pendienteOT');
Route::get('/pendienteot/listar_pendientes', 'App\Http\Controllers\API\GestionOrdenes\PendienteOTController@listar_pendientes');
Route::post('/pendienteot/create', 'App\Http\Controllers\API\GestionOrdenes\PendienteOTController@create');
Route::delete('/pendienteot/delete/{id}', 'App\Http\Controllers\API\GestionOrdenes\PendienteOTController@delete');
Route::put('/pendienteot/update/{id}', 'App\Http\Controllers\API\GestionOrdenes\PendienteOTController@update');

// Rutas Gestión Mantenimiento
Route::get('/marcas/listar_marcas', 'App\Http\Controllers\API\Mantenimiento\MarcasController@listar_marcas');
Route::post('/marcas/create', 'App\Http\Controllers\API\Mantenimiento\MarcasController@create');
Route::get('/marcas/get/{id}', 'App\Http\Controllers\API\Mantenimiento\MarcasController@get');
Route::delete('/marcas/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\MarcasController@delete');
Route::put('/marcas/update/{id}', 'App\Http\Controllers\API\Mantenimiento\MarcasController@update');

Route::get('/nombrecargoot/listar_nombrecargoot', 'App\Http\Controllers\API\Mantenimiento\NombreCargoOTController@listar_nombrecargoot');
Route::post('/nombrecargoot/create', 'App\Http\Controllers\API\Mantenimiento\NombreCargoOTController@create');
Route::get('/nombrecargoot/get/{id}', 'App\Http\Controllers\API\Mantenimiento\NombreCargoOTController@get');
Route::delete('/nombrecargoot/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\NombreCargoOTController@delete');
Route::put('/nombrecargoot/update/{id}', 'App\Http\Controllers\API\Mantenimiento\NombreCargoOTController@update');

Route::get('/inventarioequipo/listar_inventarioequipo', 'App\Http\Controllers\API\Mantenimiento\InventarioEquipoController@listar_inventarioequipo');
Route::post('/inventarioequipo/create', 'App\Http\Controllers\API\Mantenimiento\InventarioEquipoController@create');
Route::get('/inventarioequipo/get/{id}', 'App\Http\Controllers\API\Mantenimiento\InventarioEquipoController@get');
Route::get('/inventarioequipo/leerinventarioequipo/{id}', 'App\Http\Controllers\API\Mantenimiento\InventarioEquipoController@leerinventarioequipo');
Route::delete('/inventarioequipo/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\InventarioEquipoController@delete');
Route::put('/inventarioequipo/update/{id}', 'App\Http\Controllers\API\Mantenimiento\InventarioEquipoController@update');

Route::get('/datoshorometro/listar_datoshorometro', 'App\Http\Controllers\API\Mantenimiento\DatosHorometroController@listar_datoshorometro');
Route::post('/datoshorometro/create', 'App\Http\Controllers\API\Mantenimiento\DatosHorometroController@create');
Route::get('/datoshorometro/get/{id}', 'App\Http\Controllers\API\Mantenimiento\DatosHorometroController@get');
Route::delete('/datoshorometro/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\DatosHorometroController@delete');
Route::put('/datoshorometro/update/{id}', 'App\Http\Controllers\API\Mantenimiento\DatosHorometroController@update');

Route::get('/estadosclientes/listar_estadosclientes', 'App\Http\Controllers\API\Mantenimiento\EstadosClienteController@listar_estadosclientes');
Route::post('/estadosclientes/create', 'App\Http\Controllers\API\Mantenimiento\EstadosClienteController@create');
Route::get('/estadosclientes/get/{id}', 'App\Http\Controllers\API\Mantenimiento\EstadosClienteController@get');
Route::delete('/estadosclientes/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\EstadosClienteController@delete');
Route::put('/estadosclientes/update/{id}', 'App\Http\Controllers\API\Mantenimiento\EstadosClienteController@update');

Route::get('/estadoscalidad/listar_estadoscalidad', 'App\Http\Controllers\API\Mantenimiento\EstadosCalidadController@listar_estadoscalidad');
Route::post('/estadoscalidad/create', 'App\Http\Controllers\API\Mantenimiento\EstadosCalidadController@create');
Route::get('/estadoscalidad/get/{id}', 'App\Http\Controllers\API\Mantenimiento\EstadosCalidadController@get');
Route::delete('/estadoscalidad/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\EstadosCalidadController@delete');
Route::put('/estadoscalidad/update/{id}', 'App\Http\Controllers\API\Mantenimiento\EstadosCalidadController@update');

Route::get('/estadosmtto/listar_estadosmtto', 'App\Http\Controllers\API\Mantenimiento\EstadosMttoController@listar_estadosmtto');
Route::post('/estadosmtto/create', 'App\Http\Controllers\API\Mantenimiento\EstadosMttoController@create');
Route::get('/estadosmtto/get/{id}', 'App\Http\Controllers\API\Mantenimiento\EstadosMttoController@get');
Route::delete('/estadosmtto/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\EstadosMttoController@delete');
Route::put('/estadosmtto/update/{id}', 'App\Http\Controllers\API\Mantenimiento\EstadosMttoController@update');

Route::get('/gruposequipos/listar_gruposequipos', 'App\Http\Controllers\API\Mantenimiento\GruposEquiposController@listar_gruposequipos');
Route::post('/gruposequipos/create', 'App\Http\Controllers\API\Mantenimiento\GruposEquiposController@create');
Route::get('/gruposequipos/get/{id}', 'App\Http\Controllers\API\Mantenimiento\GruposEquiposController@get');
Route::delete('/gruposequipos/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\GruposEquiposController@delete');
Route::put('/gruposequipos/update/{id}', 'App\Http\Controllers\API\Mantenimiento\GruposEquiposController@update');

Route::get('/subgrupospartes/listar_subgrupospartes', 'App\Http\Controllers\API\Mantenimiento\SubGruposPartesController@listar_subgrupospartes');
Route::get('/subgrupospartes/listar_subgrupospartesequipos', 'App\Http\Controllers\API\Mantenimiento\SubGruposPartesController@listar_subgrupospartesequipos');
Route::get('/subgrupospartes/listar_subgrupospartescomponentes', 'App\Http\Controllers\API\Mantenimiento\SubGruposPartesController@listar_subgrupospartescomponentes');
Route::get('/subgrupospartes/listar_consecutivocontratos', 'App\Http\Controllers\API\Mantenimiento\SubGruposPartesController@listar_consecutivocontratos');
Route::get('/subgrupospartes/listar_consecutivoseguros', 'App\Http\Controllers\API\Mantenimiento\SubGruposPartesController@listar_consecutivoseguros');
Route::post('/subgrupospartes/create', 'App\Http\Controllers\API\Mantenimiento\SubGruposPartesController@create');
Route::get('/subgrupospartes/get/{id}', 'App\Http\Controllers\API\Mantenimiento\SubGruposPartesController@get');
Route::delete('/subgrupospartes/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\SubGruposPartesController@delete');
Route::put('/subgrupospartes/update/{id}', 'App\Http\Controllers\API\Mantenimiento\SubGruposPartesController@update');
Route::put('/subgrupospartes/actualizaconsecutivo/{id}', 'App\Http\Controllers\API\Mantenimiento\SubGruposPartesController@actualizaconsecutivo');

Route::get('/tiposfallas/listar_tiposfallas', 'App\Http\Controllers\API\Mantenimiento\TiposFallasController@listar_tiposfallas');
Route::post('/tiposfallas/create', 'App\Http\Controllers\API\Mantenimiento\TiposFallasController@create');
Route::get('/tiposfallas/get/{id}', 'App\Http\Controllers\API\Mantenimiento\TiposFallasController@get');
Route::delete('/tiposfallas/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\TiposFallasController@delete');
Route::put('/tiposfallas/update/{id}', 'App\Http\Controllers\API\Mantenimiento\TiposFallasController@update');

Route::get('/fallasmtto/listar_fallasmtto', 'App\Http\Controllers\API\Mantenimiento\FallasMttoController@listar_fallasmtto');
Route::get('/fallasmtto/leerfallatipo/{id}', 'App\Http\Controllers\API\Mantenimiento\FallasMttoController@leerfallatipo');
Route::post('/fallasmtto/create', 'App\Http\Controllers\API\Mantenimiento\FallasMttoController@create');
Route::get('/fallasmtto/get/{id}', 'App\Http\Controllers\API\Mantenimiento\FallasMttoController@get');
Route::delete('/fallasmtto/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\FallasMttoController@delete');
Route::put('/fallasmtto/update/{id}', 'App\Http\Controllers\API\Mantenimiento\FallasMttoController@update');

Route::get('/frecuencias/listar_frecuencias', 'App\Http\Controllers\API\Mantenimiento\FrecuenciasController@listar_frecuencias');
Route::post('/frecuencias/create', 'App\Http\Controllers\API\Mantenimiento\FrecuenciasController@create');
Route::get('/frecuencias/get/{id}', 'App\Http\Controllers\API\Mantenimiento\FrecuenciasController@get');
Route::delete('/frecuencias/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\FrecuenciasController@delete');
Route::put('/frecuencias/update/{id}', 'App\Http\Controllers\API\Mantenimiento\FrecuenciasController@update');

Route::get('/clasificacionabc/listar_clasificacionabc', 'App\Http\Controllers\API\Mantenimiento\ClasificacionABCController@listar_clasificacionabc');
Route::post('/clasificacionabc/create', 'App\Http\Controllers\API\Mantenimiento\ClasificacionABCController@create');
Route::get('/clasificacionabc/get/{id}', 'App\Http\Controllers\API\Mantenimiento\ClasificacionABCController@get');
Route::delete('/clasificacionabc/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\ClasificacionABCController@delete');
Route::put('/clasificacionabc/update/{id}', 'App\Http\Controllers\API\Mantenimiento\ClasificacionABCController@update');

Route::get('/remision/listar_remision', 'App\Http\Controllers\API\Mantenimiento\RemisionController@listar_remision');
Route::post('/remision/create', 'App\Http\Controllers\API\Mantenimiento\RemisionController@create');
Route::get('/remision/get/{id}', 'App\Http\Controllers\API\Mantenimiento\RemisionController@get');
Route::delete('/remision/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\RemisionController@delete');
Route::put('/remision/update/{id}', 'App\Http\Controllers\API\Mantenimiento\RemisionController@update');

Route::get('/cambioelementos/listar_cambioelementos', 'App\Http\Controllers\API\Mantenimiento\CambioElementosController@listar_cambioelementos');
Route::post('/cambioelementos/create', 'App\Http\Controllers\API\Mantenimiento\CambioElementosController@create');
Route::get('/cambioelementos/get/{id}', 'App\Http\Controllers\API\Mantenimiento\CambioElementosController@get');
Route::delete('/cambioelementos/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\CambioElementosController@delete');
Route::put('/cambioelementos/update/{id}', 'App\Http\Controllers\API\Mantenimiento\CambioElementosController@update');

Route::get('/incremento/listar_incrementocanon', 'App\Http\Controllers\API\Mantenimiento\IncrementoCanonController@listar_incrementocanon');
Route::post('/incremento/create', 'App\Http\Controllers\API\Mantenimiento\IncrementoCanonController@create');
Route::get('/incremento/get/{id}', 'App\Http\Controllers\API\Mantenimiento\IncrementoCanonController@get');
Route::delete('/incremento/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\IncrementoCanonController@delete');
Route::put('/incremento/update/{id}', 'App\Http\Controllers\API\Mantenimiento\IncrementoCanonController@update');

Route::get('/referencias/listar_referencias', 'App\Http\Controllers\API\Mantenimiento\ReferenciasController@listar_referencias');
Route::post('/referencias/create', 'App\Http\Controllers\API\Mantenimiento\ReferenciasController@create');
Route::get('/referencias/get/{id}', 'App\Http\Controllers\API\Mantenimiento\ReferenciasController@get');
Route::delete('/referencias/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\ReferenciasController@delete');
Route::put('/referencias/update/{id}', 'App\Http\Controllers\API\Mantenimiento\ReferenciasController@update');

Route::get('/equipos/listar_equipos', 'App\Http\Controllers\API\Mantenimiento\EquiposController@listar_equipos');
Route::get('/equipos/listar_reporteequipos', 'App\Http\Controllers\API\Mantenimiento\EquiposController@listar_reporteequipos');
Route::get('/equipos/listar_bajasequiposhistoricos', 'App\Http\Controllers\API\Mantenimiento\EquiposController@listar_bajasequiposhistoricos');
Route::get('/equipos/listar_equiposmontacargas', 'App\Http\Controllers\API\Mantenimiento\EquiposController@listar_equiposmontacargas');
Route::get('/equipos/listar_equiposmontacargasusuario', 'App\Http\Controllers\API\Mantenimiento\EquiposController@listar_equiposmontacargasusuario');
Route::get('/equipos/listar_alertasestadosequipos/{id}', 'App\Http\Controllers\API\Mantenimiento\EquiposController@listar_alertasestadosequipos');
Route::get('/equipos/sumatotalequipos', 'App\Http\Controllers\API\Mantenimiento\EquiposController@sumatotalequipos');
Route::get('/equipos/detalleequipos', 'App\Http\Controllers\API\Mantenimiento\EquiposController@detalleequipos');
Route::get('/equipos/listar_activosrenta', 'App\Http\Controllers\API\Mantenimiento\EquiposController@listar_activosrenta');
Route::get('/equipos/listar_activosasegurados', 'App\Http\Controllers\API\Mantenimiento\EquiposController@listar_activosasegurados');
Route::get('/equipos/listar_equiposaccesorios', 'App\Http\Controllers\API\Mantenimiento\EquiposController@listar_equiposaccesorios');
Route::get('/equipos/listar_equiposaccesorioscargadores', 'App\Http\Controllers\API\Mantenimiento\EquiposController@listar_equiposaccesorioscargadores');
Route::get('/equipos/listar_equiposaccesoriosbaterias', 'App\Http\Controllers\API\Mantenimiento\EquiposController@listar_equiposaccesoriosbaterias');
Route::post('/equipos/create', 'App\Http\Controllers\API\Mantenimiento\EquiposController@create');
Route::get('/equipos/get/{id}', 'App\Http\Controllers\API\Mantenimiento\EquiposController@get');
Route::delete('/equipos/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\EquiposController@delete');
Route::put('/equipos/update/{id}', 'App\Http\Controllers\API\Mantenimiento\EquiposController@update');

Route::get('/extrasequipos/listar_extrasequipos', 'App\Http\Controllers\API\Mantenimiento\ExtrasEquiposController@listar_extrasequipos');
Route::post('/extrasequipos/create', 'App\Http\Controllers\API\Mantenimiento\ExtrasEquiposController@create');
Route::get('/extrasequipos/get/{id}', 'App\Http\Controllers\API\Mantenimiento\ExtrasEquiposController@get');
Route::delete('/extrasequipos/delete/{id}', 'App\Http\Controllers\API\Mantenimiento\ExtrasEquiposController@delete');
Route::put('/extrasequipos/update/{id}', 'App\Http\Controllers\API\Mantenimiento\ExtrasEquiposController@update');

