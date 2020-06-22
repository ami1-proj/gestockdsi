<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employe;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define( App\Employe::class, function (Faker $faker) {
    return [
        'nom' => $faker->lastName,
        'matricule' => Str::random(10),
        'prenom' =>$faker->firstName,
        'fonction_employe_id' => $faker->numberBetween($min = 1, $max = 10),
        'adresse' => $faker->address,
        'statut_id' => 1,
    ];
});

$factory->state(App\Employe::class, 'direction', function (Faker $faker) {
    return [
        'departement_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

$factory->state(App\Employe::class, 'division', function (Faker $faker) {
    return [
        'departement_id' => $faker->numberBetween($min = 6, $max = 18),
    ];
});

$factory->state(App\Employe::class, 'service', function (Faker $faker) {
    return [
        'departement_id' => $faker->numberBetween($min = 18, $max = 86),
    ];
});

$factory->state(App\Employe::class, 'zone', function (Faker $faker) {
    return [
        'departement_id' => $faker->numberBetween($min = 87, $max = 91),
    ];
});

$factory->state(App\Employe::class, 'agence', function (Faker $faker) {
    return [
        'departement_id' => $faker->numberBetween($min = 92, $max = 132),
    ];
});
