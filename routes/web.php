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

Route::get( '/Login',                       ['as' => 'login',                    'uses' => 'Auth\LoginController@showLoginForm']);
Route::post( '/Login',                      [                                    'uses' => 'Auth\LoginController@login']);

//Routes nécéssitant d'être connecté
Route::group(['middleware' => 'auth'], function()
{
  Route::get( '/',                            ['as' => 'Accueil',                   'uses' => 'GestionController@index']);

  Route::get( '/Groupes',                     ['as' => 'Groupes',                   'uses' => 'GroupeController@lister']);
  Route::get( '/Groupes/Ajout',               ['as' => 'GroupeAjout',               'uses' => 'GroupeController@ajouter']);
  Route::get( '/Groupes/{id}',                ['as' => 'FicheGroupe',               'uses' => 'GroupeController@afficher']);
  Route::post('/Groupes',                     ['as' => 'GroupeEnregistrer',         'uses' => 'GroupeController@enregistrer']);
  Route::put( '/Groupes/{id}',                ['as' => 'GroupeMAJ',                 'uses' => 'GroupeController@mettreAJour']);
  Route::delete( '/Groupes/{id}',             ['as' => 'GroupeSupprimer',           'uses' => 'GroupeController@supprimer']);
  Route::get( '/Groupes/{id}/Modifier',       ['as' => 'GroupeModifier',            'uses' => 'GroupeController@modifier']);


  Route::get( '/Interlocuteurs',              ['as' => 'Interlocuteurs',            'uses' => 'InterlocuteurController@lister']);
  Route::get( '/Interlocuteurs/Ajout',        ['as' => 'InterlocuteurAjout',        'uses' => 'InterlocuteurController@ajouter']);
  Route::get( '/Interlocuteurs/Mail',         ['as' => 'listeMail',                 'uses' => 'InterlocuteurController@listeMail']);
  Route::get( '/Interlocuteurs/{id}',         ['as' => 'FicheInterlocuteur',        'uses' => 'InterlocuteurController@afficher']);
  Route::post('/Interlocuteurs',              ['as' => 'InterlocuteurEnregistrer',  'uses' => 'InterlocuteurController@enregistrer']);
  Route::put( '/Interlocuteurs/{id}',         ['as' => 'InterlocuteurMAJ',          'uses' => 'InterlocuteurController@mettreAJour']);
  Route::delete( '/Interlocuteurs/{id}',      ['as' => 'InterlocuteurSupprimer',    'uses' => 'InterlocuteurController@supprimer']);
  Route::get( '/Interlocuteurs/{id}/Modifier',['as' => 'InterlocuteurModifier',     'uses' => 'InterlocuteurController@modifier']);


  Route::get( '/Actions',                     ['as' => 'Actions',                   'uses' => 'ActionController@lister']);
  Route::get( '/Actions/Ajout',               ['as' => 'ActionAjout',               'uses' => 'ActionController@ajouter']);
  Route::get( '/Actions/{id}',                ['as' => 'FicheAction',               'uses' => 'ActionController@afficher']);
  Route::post('/Actions',                     ['as' => 'ActionEnregistrer',         'uses' => 'ActionController@enregistrer']);
  Route::put( '/Actions/{id}',                ['as' => 'ActionMAJ',                 'uses' => 'ActionController@mettreAJour']);
  Route::delete( '/Actions/{id}',             ['as' => 'ActionSupprimer',           'uses' => 'ActionController@supprimer']);
  Route::get( '/Actions/{id}/Ajout',          ['as' => 'ActionAjoutEntreprise',     'uses' => 'ActionController@ajouterEnt']);
  Route::get( '/Actions/{id}/Modifier',       ['as' => 'ActionModifier',            'uses' => 'ActionController@modifier']);


  Route::get( '/Partenaires',                 ['as' => 'Partenaires',               'uses' => 'EntrepriseController@listerPartenaires']);
  Route::get( '/Entreprises',                 ['as' => 'Entreprises',               'uses' => 'EntrepriseController@listerEntreprises']);
  Route::post('/Entreprises',                 ['as' => 'EntrepriseEnregistrer',     'uses' => 'EntrepriseController@enregistrer']);
  Route::get( '/Entreprises/Ajout',           ['as' => 'EntrepriseAjout',           'uses' => 'EntrepriseController@ajouter']);
  Route::get( '/Entreprises/Mails',           ['as' => 'EntrepriseMailsForm',       'uses' => 'EntrepriseController@formulaireMailsEntreprise']);
  Route::post( '/Entreprises/Mails',          ['as' => 'EntrepriseMails',           'uses' => 'EntrepriseController@mailsEntreprise']);
  Route::get( '/Entreprises/{id}',            ['as' => 'FicheEntreprise',           'uses' => 'EntrepriseController@afficher']);
  Route::put( '/Entreprises/{id}',            ['as' => 'EntrepriseMAJ',             'uses' => 'EntrepriseController@mettreAJour']);
  Route::delete( '/Entreprises/{id}',         ['as' => 'EntrepriseSupprimer',       'uses' => 'EntrepriseController@supprimer']);
  Route::get( '/Entreprises/{id}/Modifier',   ['as' => 'EntrepriseModifier',        'uses' => 'EntrepriseController@modifier']);


  Route::get( '/Contacts/{id}',               ['as' => 'FicheContact',              'uses' => 'ContactController@afficher']);
  Route::post('/Contacts',                    ['as' => 'ContactEnregistrer',        'uses' => 'ContactController@enregistrer']);
  Route::put( '/Contacts/{id}',               ['as' => 'ContactMAJ',                'uses' => 'ContactController@mettreAJour']);
  Route::delete( '/Contacts/{id}',            ['as' => 'ContactSupprimer',          'uses' => 'ContactController@supprimer']);
  Route::get( '/Contacts/{id}/Ajout',         ['as' => 'ContactAjout',              'uses' => 'ContactController@ajouter']);
  Route::get( '/Contacts/{id}/Modifier',      ['as' => 'ContactModifier',           'uses' => 'ContactController@modifier']);


  Route::get( '/Badges',                      ['as' => 'BadgesForm',                'uses' => 'GestionController@formulaireBadges']);
  Route::post( '/Badges',                     ['as' => 'Badges',                    'uses' => 'GestionController@genererBadges']);

  Route::post('/Recherche/Actions',           ['as' => 'rechercheActions',          'uses' => 'ActionController@recherche']);
  Route::post('/Recherche/Groupes',           ['as' => 'rechercheGroupes',          'uses' => 'GroupeController@recherche']);
  Route::post('/Recherche/Entreprises',       ['as' => 'rechercheEntreprises',      'uses' => 'EntrepriseController@recherche']);
  Route::post('/Recherche/Interlocuteurs',    ['as' => 'rechercheInterlocuteurs',   'uses' => 'InterlocuteurController@recherche']);
  Route::post('/Recherche/EntreprisesDist',   ['as' => 'rechercheEntreprisesDist',  'uses' => 'EntrepriseController@rechercheDist']);

  Route::post( '/Logout',                     ['as' => 'logout',                   'uses' => 'Auth\LoginController@logout']);
});
