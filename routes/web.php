<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('main');
});


Route::get('/principal', function () {
    return view("main");
});

Route::get('/contato', "App\Http\Controllers\ContatoController@index");


Route::get('/pai', function () {
    return view("layouts.app");
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/cliente', "App\Http\Controllers\ClienteController@index");
    Route::get('/cliente/create', "App\Http\Controllers\ClienteController@create");
    Route::post('/cliente/store', "App\Http\Controllers\ClienteController@store");
    Route::get('/cliente/edit/{id}', "App\Http\Controllers\ClienteController@edit");
    Route::post('/cliente/update/{id}', "App\Http\Controllers\ClienteController@update");
    Route::get('/cliente/show/{id}', "App\Http\Controllers\ClienteController@show");
    Route::get('/cliente/destroy/{id}', "App\Http\Controllers\ClienteController@destroy");
    Route::post('/cliente/search/', "App\Http\Controllers\ClienteController@search");

    Route::get('/peca', "App\Http\Controllers\PecaController@index");
    Route::get('/peca/create', "App\Http\Controllers\PecaController@create");
    Route::post('/peca/store', "App\Http\Controllers\PecaController@store");
    Route::get('/peca/edit/{id}', "App\Http\Controllers\PecaController@edit");
    Route::post('/peca/update/{id}', "App\Http\Controllers\PecaController@update");
    Route::get('/peca/show/{id}', "App\Http\Controllers\PecaController@show");
    Route::get('/peca/destroy/{id}', "App\Http\Controllers\PecaController@destroy");
    Route::post('/peca/search/', "App\Http\Controllers\PecaController@search");

    Route::get('/funcionario', "App\Http\Controllers\FuncionarioController@index");
    Route::get('/funcionario/create', "App\Http\Controllers\FuncionarioController@create");
    Route::post('/funcionario/store', "App\Http\Controllers\FuncionarioController@store");
    Route::get('/funcionario/edit/{id}', "App\Http\Controllers\FuncionarioController@edit");
    Route::post('/funcionario/update/{id}', "App\Http\Controllers\FuncionarioController@update");
    Route::get('/funcionario/show/{id}', "App\Http\Controllers\FuncionarioController@show");
    Route::get('/funcionario/destroy/{id}', "App\Http\Controllers\FuncionarioController@destroy");
    Route::post('/funcionario/search/', "App\Http\Controllers\FuncionarioController@search");

    Route::get('/cliente-relatorio', "App\Http\Controllers\ClienteController@gerarClientePDF");
    Route::get('/peca-relatorio', "App\Http\Controllers\PecaController@gerarPecaPDF");
    Route::get('/funcionario-relatorio', "App\Http\Controllers\FuncionarioController@gerarFuncionarioPDF");

    Route::get('/cliente-email', "App\Http\Controllers\ClienteController@sendEmail");
});
