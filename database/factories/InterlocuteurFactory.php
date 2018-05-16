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

$factory->define(App\Interlocuteur::class, function (Faker $faker) {
    $faker = Fak::create('fr_FR');
    $k=rand(0,1);
    if($k){
      $genre='male';
    }
    else{
      $genre='female';
    }
    return [
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName($genre),
        'fonction' => $faker->jobTitle,
        'civilite' => $faker->title($genre),
        'telFixe' => $faker->phoneNumber,
        'telMobile' => $faker->phoneNumber,
        'mail' => $faker->email,
        'transmission' => $faker->boolean($chanceOfGettingTrue = 50),
        'commentaire' => $faker->text($maxNbChars = 200),
    ];
});
