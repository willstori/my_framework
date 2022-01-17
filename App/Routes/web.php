<?php
/*
*
* Arquivo utilizado para declaração das rotas da aplicação
*
* 
* Exemplo Estático .: Route::get("sua/rota", "App\Controllers\SeuController", "seuMetodo");

* Exemplo Dinâmico .: Route::get("sua/rota/{nome_do_parametro}", "App\Controller\SeuController", "seuMetodo");
*
* Obs.: Lembrando que estão disponíveis os verbos: get, post, put e delete. 
*
*/
use System\Route;

// Configuração da rota Padrão
Route::get('/', 'App\Controllers\Home');

Route::get('home', 'App\Controllers\Home');

Route::get('noticias', 'App\Controllers\Noticias');

Route::post('noticias', 'App\Controllers\Noticias', 'insert');

Route::get('noticias/register', 'App\Controllers\Noticias', 'register');

Route::post('noticias/update', 'App\Controllers\Noticias', 'update');

Route::get('noticias/edit/{id}', 'App\Controllers\Noticias', 'edit');

Route::get('noticias/delete/{id}', 'App\Controllers\Noticias', 'delete');

Route::get('noticias/{id}', 'App\Controllers\Noticias', 'show');

// Configuração da rota de erro Página não encontrada
Route::error('404', "App\Controllers\Error", "notFound");