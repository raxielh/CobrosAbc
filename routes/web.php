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

Route::resource('capital', 'CapitalController');
Route::get('/capital_get', 'CapitalController@get_data_capital')->name('capital_get');

Route::resource('prestamo', 'PrestamoController');
Route::get('/prestamo_get', 'PrestamoController@get_data_prestamo')->name('prestamo_get');
Route::get('/prestamo_ordenar', 'PrestamoController@ordenar');
Route::get('/prestamo_ordenar_plus/{prestamo}', 'PrestamoController@plus');
Route::get('/prestamo_ordenar_minus/{prestamo}', 'PrestamoController@minus');

Route::resource('pago', 'PagoController');
Route::get('/pago_get/{prestamo}', 'PagoController@get_data_pago')->name('pago_get');

Route::resource('cobrador', 'CobradorController');
Route::get('/cobrador_get', 'CobradorController@get_data_cobrador')->name('cobrador_get');

Route::resource('offline', 'OfflineController');


Route::resource('admin', 'AdministradorController');

Route::resource('usuarios', 'UsuariosController');
Route::get('/usuarios_get', 'UsuariosController@get_data_usuarios')->name('usuarios_get');

Route::resource('tipop', 'TipoPrestamoController');
Route::get('/tipop_get', 'TipoPrestamoController@get_data_tipop')->name('tipop_get');