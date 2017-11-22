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

Route::get('/', 'HomeController@index')->name('home');

Route::resource('productos', 'ProductosController',['except' => ['show']]);

Route::get('productos/{slug}', 'ProductosController@getCompra');

Route::get('compras/payments','ProductosController@getPayments');

Route::resource('compras', 'ComprasController',['except' => ['show']]);

Route::get('productos/{id}/delete',['as'=>'productos.delete','uses'=>'ProductosController@delete']);


Route::get('ml', 'ProductosController@getCreatePreference');

Route::get('publicados/json', 'ProductosController@getJson');

Route::post('procesar',['as'=>'productos.procesar','uses'=>'ProductosController@procesarPago']);

Route::get('compras/{id}/finalizar',['as'=>'compras.finalizar','uses'=>'ProductosController@finalizar']);


Route::get('publicados/json', 'ProductosController@getJson');

Route::get('publicados/stock', 'ProductosController@getJsonStock');

Route::get('publicados/pedido', 'ProductosController@getJsonPedido');

Route::get('compras/exito','ProductosController@msgExito');



