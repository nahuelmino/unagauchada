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

// Usuarios
Route::get('home', 'HomeController@index')->name('home');
Route::get('editar-perfil', 'UsersController@edit');
Route::post('users', 'UsersController@update');
Route::get('cambiar-contrasena', 'UsersController@editPassword');
Route::post('cambiar-contrasena', 'UsersController@updatePassword');

//-- Comprar créditos
Route::get('comprar', 'ComprasController@index')->name('comprar');
Route::post('compras', 'ComprasController@generar');

//-- Gauchadas
Route::get('/gauchadas', 'GauchadasController@index')->name('gauchadas');
Route::get('/gauchadas/user', 'GauchadasController@userGauchadas');

Route::get('/gauchadas/create', 'GauchadasController@create');
Route::post('/gauchadas/create', 'GauchadasController@store');

Route::get('/gauchadas/{id}', 'GauchadasController@show');

Route::get('/gauchadas/{id}/postulaciones', 'GauchadasController@postulaciones');
Route::post('/gauchadas/{id}/calificar', 'GauchadasController@calificar');

Route::get('/gauchadas/{id}/edit', 'GauchadasController@edit');
Route::post('/gauchadas/{id}/edit', 'GauchadasController@update');

Route::get('/gauchadas/{id}/delete', 'GauchadasController@destroy');

//-- Preguntas
Route::post('/preguntas', 'PreguntasController@store');
Route::post('/preguntas/{id}', 'PreguntasController@update');

//-- Postulaciones
Route::post('/postulaciones/add', 'PostulacionesController@add');
Route::get('/postulaciones/{id}/accept', 'PostulacionesController@accept');

// Admin
Route::get('/admin', 'UsersController@admin');

//-- Listados
Route::get('/admin/balances', 'UsersController@balances');
Route::get('/admin/listusers', 'UsersController@listusers');

//-- Rangos
Route::get('/admin/rangos', 'RangosController@index');

Route::get('/admin/rangos/add', 'RangosController@add');
Route::post('/admin/rangos/add', 'RangosController@store');

Route::get('/admin/rangos/{id}/edit', 'RangosController@edit');
Route::post('/admin/rangos/{id}/edit', 'RangosController@update');

Route::get('/admin/credits', 'CreditsController@edit');
Route::post('/admin/credits', 'CreditsController@update');

Route::get('/admin/rangos/{id}/delete', 'RangosController@delete');

//-- Categorias
Route::get('/admin/categorias', 'CategoriasController@index');

Route::get('/admin/categorias/add', 'CategoriasController@add');
Route::post('/admin/categorias/add', 'CategoriasController@store');

Route::get('/admin/categorias/{id}/edit', 'CategoriasController@edit');
Route::post('/admin/categorias/{id}/edit', 'CategoriasController@update');

Route::get('/admin/categorias/{id}/delete', 'CategoriasController@delete');