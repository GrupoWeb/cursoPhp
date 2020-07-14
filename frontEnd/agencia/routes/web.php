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

Auth::routes();
Route::get('/','AgenciaController@index')->name('index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => ['auth']] , function () {
    Route::get('ofertas','OfertasController@createOfertas')->name('ofertas');
    Route::post('upload','OfertasController@store');
    Route::post('uploadfile','OfertasController@uploadFile')->name('upload');
    Route::get('getOfertas','OfertasController@getOfertas')->name('getOfertas');
    Route::get('agenda','OfertasController@MostrarAgenda')->name('agendar');
    Route::get('paquetes','OfertasController@getPaquetes')->name('paquetes');
    Route::post('paquetes','OfertasController@addPaquetes')->name('addPaquete');
    Route::get('consulta','OfertasController@consulta')->name('consulta');
    Route::get('getConsulta','OfertasController@getConsulta')->name('getConsulta');
});
