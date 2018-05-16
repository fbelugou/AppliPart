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

$factory->define(App\Action::class, function (Faker $faker) {
    $faker = Fak::create('fr_FR');
    return [
        'nature' => ' ',
        'date' => $faker->dateTimeBetween($startDate = '-6 years', $endDate = 'now', $timezone = null),
        'commentaire' => $faker->text($maxNbChars = 200),
    ];
});
