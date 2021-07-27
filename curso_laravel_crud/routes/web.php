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

use App\Mail\NovaSerie;
use Illuminate\Support\Facades\Mail;

Route::get('/series', 'SeriesController@index')->name('listar_series');;
Route::get('/series/adicionar', 'SeriesController@create')->name('criar_serie');
Route::post('/series/adicionar', 'SeriesController@store');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome');
Route::delete('/series/remover/{id}', 'SeriesController@destroy');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');
Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('/email', function()
{
    return new NovaSerie("ruanito",4,6);
});
Route::get('/enviandoEmail', function()
{
    $user = (object)[
        'email'=>'igvilneck@gmail.com',
        'name'=>"Igor"
    ];
    Mail::to($user)->send(new NovaSerie("ruanito",4,6));
    return "email enviado com sucesso!";
});
