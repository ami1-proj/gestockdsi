<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fournisseur;
use Faker\Generator as Faker;

$factory->define( App\Fournisseur::class, function (Faker $faker) {
    return [
        'nom' => $faker->firstName,
        'prenom' => $faker->firstName,
        'raison_sociale' => $faker->Name,
        'statut_id' => 1,
    ];
});
