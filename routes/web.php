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
