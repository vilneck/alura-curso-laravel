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

Route::get('/series', 'SeriesController@index');
Route::get('/series/adicionar', 'SeriesController@create')->name('criar_serie');
Route::post('/series/adicionar', 'SeriesController@store');
Route::delete('/series/remover/{id}', 'SeriesController@destroy');
