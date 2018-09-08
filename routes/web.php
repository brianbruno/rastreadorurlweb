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
    $search = app()->make('\App\Http\Controllers\SearchController');
    return $search->index();
});

Route::post('/buscar', function (Illuminate\Http\Request $request) {
    $homeController = app()->make('\App\Http\Controllers\SearchController');
    return $homeController->buscar($request);
})->name('buscar');

Route::get('/inserir', function () {
    $homeController = app()->make('\App\Http\Controllers\InsertController');
    return $homeController->index();
})->name('inserir');

Route::post('/inserir', function (Illuminate\Http\Request $request) {
    $homeController = app()->make('\App\Http\Controllers\InsertController');
    return $homeController->inserir($request);
})->name('inserir-url');

Route::get('/find/{id}', function ($id) {
    return view('resultado', ['id' => $id]);
})->name('find');

Route::post('/getinfo/{id}', function ($id) {
    ini_set('max_execution_time', 180);
    $homeController = app()->make('\App\Http\Controllers\SearchController');
    $resultado = $homeController->buscarOrigem($id);
    return $resultado;
});

Route::get('/bot', function() {
  $bot = app()->make('\App\Http\Controllers\Bot\Bot');
  $bot->run();
});
