<?php

use Illuminate\Support\Facades\Route;

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
    return view('/bc-gimremote');
});

// Rutas de Logueo y Registro de Usuarios
Route::get('/login', 'App\Http\Controllers\API\GimremoteController@index');
Route::get('/cumplimiento/cumplirordentecnico', 'App\Http\Controllers\API\GimremoteController@index');
Route::get('/cumplimiento/nombrecargoot', 'App\Http\Controllers\API\GimremoteController@index');
Route::get('/cumplimiento/datoshorometro', 'App\Http\Controllers\API\GimremoteController@index');
Route::get('/mantenimiento/inventarioequipo', 'App\Http\Controllers\API\GimremoteController@index');


