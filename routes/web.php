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

Route::get('/', ['as' => 'home', function(){
  return 'Je suis la page d\'accueil !';
}]);

Route::get('{n}', function($n) {
    return Response::make('Je suis la page ' . $n . ' !', 200);
})->where('n', '[1-3]');

Route::get('article/{n}', function($n) {
    return view('article', ['numero' => $n]);
    return view('article')->withNumero($n);
    return view('article')->with('numero', $n);
})->where('n', '[0-9]+');
