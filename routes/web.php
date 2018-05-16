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

Route::get( '/',                          ['as' => 'Accueil',                   'uses' => 'GestionController@index']);
Route::get( '/Groupes',                   ['as' => 'Groupes',                   'uses' => 'GroupeController@lister']);
Route::get( '/Groupes/Ajout',             ['as' => 'GroupeAjout',               'uses' => 'GroupeController@ajouter']);
Route::get( '/Groupes/{id}',              ['as' => 'FicheGroupe',               'uses' => 'GroupeController@afficher']);
Route::post('/Groupes',                   ['as' => 'GroupeEnregitrer',          'uses' => 'GroupeController@enregistrer']);
Route::put( '/Groupes/{id}',              ['as' => 'GroupeMAJ',                 'uses' => 'GroupeController@mettreAJour']);
Route::delete( '/Groupes/{id}',           ['as' => 'GroupeSupprimer',           'uses' => 'GroupeController@supprimer']);
Route::get( '/Groupes/{id}/modifier',     ['as' => 'GroupeModifier',            'uses' => 'GroupeController@modifier']);


Route::get( '/Interlocuteurs',            ['as' => 'Interlocuteurs',            'uses' => 'GestionController@listerInterlocuteurs']);
Route::get( '/Interlocuteurs/{id}',       ['as' => 'FicheInterlocuteur',        'uses' => 'GestionController@ficheInterlocuteur']);
Route::get( '/Actions',                   ['as' => 'Actions',                   'uses' => 'GestionController@listerActions']);
Route::get( '/Actions/{id}',              ['as' => 'FicheAction',               'uses' => 'GestionController@ficheAction']);
Route::get( '/Partenaires',               ['as' => 'Partenaires',               'uses' => 'EntrepriseController@listerPartenaires']);
Route::get( '/Entreprises',               ['as' => 'Entreprises',               'uses' => 'EntrepriseController@listerEntreprises']);
Route::post('/Entreprises',               ['as' => 'EntrepriseEnregitrer',      'uses' => 'EntrepriseController@enregistrer']);
Route::get( '/Entreprises/Ajout',         ['as' => 'EntrepriseAjout',           'uses' => 'EntrepriseController@ajouter']);
Route::get( '/Entreprises/{id}',          ['as' => 'FicheEntreprise',           'uses' => 'EntrepriseController@afficher']);
Route::put( '/Entreprises/{id}',          ['as' => 'EntrepriseMAJ',             'uses' => 'EntrepriseController@mettreAJour']);
Route::delete( '/Entreprises/{id}',       ['as' => 'EntrepriseSupprimer',       'uses' => 'EntrepriseController@supprimer']);
Route::get( '/Entreprises/{id}/modifier', ['as' => 'EntrepriseModifier',        'uses' => 'EntrepriseController@modifier']);
Route::get( '/Contacts/{id}',             ['as' => 'FicheContact',              'uses' => 'GestionController@ficheContact']);
Route::get( '/Badges',                    ['as' => 'Badges',                    'uses' => 'GestionController@genererBadges']);
Route::post('/recherche/Actions',         ['as' => 'rechercheActions',          'uses' => 'GestionController@index']);
Route::post('/recherche/Groupes',         ['as' => 'rechercheGroupes',          'uses' => 'GestionController@index']);
Route::post('/recherche/Entreprises',     ['as' => 'rechercheEntreprises',      'uses' => 'GestionController@index']);
Route::post('/recherche/Interlocuteurs',  ['as' => 'rechercheInterlocuteurs',   'uses' => 'GestionController@index']);
Route::post('/recherche/EntreprisesDist', ['as' => 'rechercheEntreprisesDist',  'uses' => 'GestionController@index']);

Route::resource('entreprise', 'EntrepriseController');

/*
| POST      | entreprise                    | entreprise.store         | App\Http\Controllers\EntrepriseController@store           | web
| GET|HEAD  | entreprise                    | entreprise.index         | App\Http\Controllers\EntrepriseController@index           | web
| GET|HEAD  | entreprise/create             | entreprise.create        | App\Http\Controllers\EntrepriseController@create          | web
| DELETE    | entreprise/{entreprise}       | entreprise.destroy       | App\Http\Controllers\EntrepriseController@destroy         | web
| PUT|PATCH | entreprise/{entreprise}       | entreprise.update        | App\Http\Controllers\EntrepriseController@update          | web
| GET|HEAD  | entreprise/{entreprise}       | entreprise.show          | App\Http\Controllers\EntrepriseController@show            | web
| GET|HEAD  | entreprise/{entreprise}/edit  | entreprise.edit          | App\Http\Controllers\EntrepriseController@edit            | web

------------------------------------------------------------------------

    Route::get( 'contact', 'GestionController@getInfos');
    Route::post('contact', 'GestionController@postInfos');
    return Response::make('texte', 200);
    return view('article',['numero' => $n]);
    return view('article')->withNumero($n);
    return view('article')->with('numero', $n);
*/

Auth::routes();

Route::get( '/home', 'HomeController@index')->name('home');
