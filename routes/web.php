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

Route::post('compras', 'ComprasController@generar');

Route::get('/gauchadas/create', 'GauchadasController@create');

Route::get('/gauchadas', 'GauchadasController@index')->name('gauchadas');

Route::get('/gauchadas/{id}', 'GauchadasController@show');

Route::get('/gauchadas/{id}/postulate', 'GauchadasController@postulate');

Route::get('comprar', 'ComprasController@index')->name('comprar');

Route::post('/gauchadas/create', 'GauchadasController@store');
