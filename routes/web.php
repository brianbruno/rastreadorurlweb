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
    return view('dashboard', ['visitas' => $search->contarVisitas()]);
});

Route::post('/buscar', function (Illuminate\Http\Request $request) {
    $homeController = app()->make('\App\Http\Controllers\SearchController');
    return $homeController->index($request);
})->name('buscar');

Route::get('/find/{id}', function ($id) {
    $homeController = app()->make('\App\Http\Controllers\SearchController');
    $resultado = $homeController->buscarOrigem($id);
    return view('resultado', ['resultados' => array_reverse($resultado)]);
})->name('find');
