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

$factory->define(App\Entreprise::class, function (Faker $faker) {
    $faker = Fak::create('fr_FR');
    return [
        'nom' => $faker->company,
        'partenaireRegulier' => $faker->boolean($chanceOfGettingTrue = 50),
        'siegeSocial' => $faker->boolean($chanceOfGettingTrue = 0),
        'taille' => $faker->numberBetween($min = 1, $max = 10000),
        'adresse1' => $faker->unique()->streetAddress,
        'ville' => $faker->city,
        'cp' => $faker->postcode,
        'siteWeb' => $faker->url,
        'telephone' => $faker->phoneNumber,
        'commentaire' => $faker->text($maxNbChars = 200),
        'groupe_id' => null,
        'coordonnees_id' => null
    ];
});
