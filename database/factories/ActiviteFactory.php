<?php

use Faker\Factory as Fak;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Activite::class, function (Faker $faker) {
    $faker = Fak::create('fr_FR');
    $k=rand(1,8);
    switch ($k) {
      case 1:
        return ['libelle'=> 'ESN/Conseil',];
        break;
      case 2:
        return ['libelle'=> 'Fabricant',];
        break;
      case 3:
        return ['libelle'=> 'Editeur Logiciel',];
        break;
      case 4:
        return ['libelle'=> 'DataCenter',];
        break;
      case 5:
        return ['libelle'=> 'Magasin / Réparateur',];
        break;
      case 6:
        return ['libelle'=> 'Entreprise Publique/Collectivité Locale',];
        break;
      case 7:
        return ['libelle'=> 'PME/PMI',];
        break;
      case 8:
        return ['libelle'=> 'TPE',];
        break;
    }
    return ['libelle'=> null,];
});
