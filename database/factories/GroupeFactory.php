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

$factory->define(App\Groupe::class, function (Faker $faker) {
    $faker = Fak::create('fr_FR');
    return [
        'nom' => $faker->company,
        'taille' => $faker->numberBetween($min = 1, $max = 100000),
    ];
});
