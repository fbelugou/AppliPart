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

$factory->define(App\Contact::class, function (Faker $faker) {
    $faker = Fak::create('fr_FR');
    $c=rand(1,3);
    switch ($c) {
      case 1:
        $AMIO='LP';
        break;
      case 2:
        $AMIO='DP';
        break;
      case 3:
        $AMIO='CMZ';
        break;
    }
    $o=rand(1,4);
    switch ($o) {
      case 1:
        $obj='mail';
        break;
      case 2:
        $obj='telephone';
        break;
      case 3:
        $obj='entretien';
        break;
      case 4:
        $obj='salon';
        break;
    }

    return [
        'contactAMIO' => $AMIO,
        'date' => $faker->dateTimeBetween($startDate = '-6 years', $endDate = 'now', $timezone = null),
        'objet' => $obj,
        'commentaire' => $faker->text($maxNbChars = 200),
    ];
});
