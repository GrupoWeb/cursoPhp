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
});


// Route::get('/admin', function () {
//     return view('admin.home');
// });
// Route::get('/', function () {
//     return view('welcome');
// });



