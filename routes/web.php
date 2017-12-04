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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard/{cobro}', 'DashboardController@index')->name('dashboard');

Route::resource('cobro', 'CobroController');

Route::resource('barrio', 'BarrioController');
Route::get('/barrio_get', 'BarrioController@get_data_barrio')->name('barrio_get');

Route::resource('interes', 'InteresController');
Route::get('/interes_get', 'InteresController@get_data_interes')->name('interes_get');

Route::resource('clientes', 'ClienteController');
Route::get('/clientes_get', 'ClienteController@get_data_clientes')->name('clientes_get');
