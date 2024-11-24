<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect('/login');
})->name('index');

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@index')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login.post');

Route::middleware(['auth'])->prefix('/painel')->as('painel')->group(function () {
    
    //Rotas das transações
    Route::get('/', 'App\Http\Controllers\Painel\TransacaoController@index')->name('.index');
    Route::get('/new', 'App\Http\Controllers\Painel\TransacaoController@create')->name('.create');
    Route::post('/store', 'App\Http\Controllers\Painel\TransacaoController@store')->name('.store');
    Route::get('/{id}/edit', 'App\Http\Controllers\Painel\TransacaoController@edit')->name('.edit');
    Route::put('/{id}/edit', 'App\Http\Controllers\Painel\TransacaoController@update')->name('.update');
    Route::delete('/{id}', 'App\Http\Controllers\Painel\TransacaoController@destroy')->name('.destroy');
    Route::get('/{id}', 'App\Http\Controllers\Painel\TransacaoController@show')->name('.show');
    Route::get('/files/{id}', 'App\Http\Controllers\Painel\TransacaoController@showFile')->name('.files.show');

    //LOGOUT
    Route::post('/logout', 'App\Http\Controllers\Auth\LogoutController@destroy')->name('.logout');    
});