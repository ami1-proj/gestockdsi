<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AdresseemailEmploye;
use Faker\Generator as Faker;

$factory->define(App\AdresseemailEmploye::class, function (Faker $faker) {
    return [
        'rang' => $faker->numberBetween($min = 1, $max = 15),
        'employe_id' =>1,
        'adresseemail_id' =>1,
        'statut_id' =>1,
    ];
});
