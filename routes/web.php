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

Route::get('/', ['as' => 'accueil', 'uses' => 'GestionController@index']);
Route::post('/recherche/Actions', ['as' => 'rechercheActions', 'uses' => 'GestionController@index']);
Route::post('/recherche/Groupes', ['as' => 'rechercheGroupes', 'uses' => 'GestionController@index']);
Route::post('/recherche/Entreprises', ['as' => 'rechercheEntreprises', 'uses' => 'GestionController@index']);
Route::post('/recherche/Interlocuteurs', ['as' => 'rechercheInterlocuteurs', 'uses' => 'GestionController@index']);
Route::post('/recherche/EntreprisesDist', ['as' => 'rechercheEntreprisesDist', 'uses' => 'GestionController@index']);


/*
    Route::get('contact', 'GestionController@getInfos');
    Route::post('contact', 'GestionController@postInfos');
    return Response::make('texte', 200);
    return view('article',['numero' => $n]);
    return view('article')->withNumero($n);
    return view('article')->with('numero', $n);
*/
