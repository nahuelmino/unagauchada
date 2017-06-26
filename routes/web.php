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
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('editar-perfil', 'UsersController@edit');

Route::post('users', 'UsersController@update');

Route::get('cambiar-contrasena', 'UsersController@editPassword');

Route::post('cambiar-contrasena', 'UsersController@updatePassword');

Route::post('compras', 'ComprasController@generar');

Route::get('/gauchadas/create', 'GauchadasController@create');

Route::post('/gauchadas/create', 'GauchadasController@store');

Route::get('/gauchadas', 'GauchadasController@index')->name('gauchadas');

Route::get('/gauchadas/user', 'GauchadasController@userGauchadas');

Route::get('/gauchadas/{id}', 'GauchadasController@show');

Route::get('/gauchadas/{id}/edit', 'GauchadasController@edit');

Route::get('/gauchadas/{id}/delete', 'GauchadasController@destroy');

Route::get('/gauchadas/{id}/postulaciones', 'GauchadasController@postulaciones');

Route::post('/preguntas', 'PreguntasController@store');
Route::post('/preguntas/{id}', 'PreguntasController@update');

Route::post('/postulaciones/add', 'PostulacionesController@add');

Route::get('/postulaciones/{id}/accept', 'PostulacionesController@accept');

Route::get('comprar', 'ComprasController@index')->name('comprar');
