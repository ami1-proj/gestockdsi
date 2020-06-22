<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FournisseursAdresseemail;
use Faker\Generator as Faker;

$factory->define(App\FournisseursAdresseemail::class, function (Faker $faker) {
    return [
        'rang' => $faker->numberBetween($min = 1, $max = 15),
        'fournisseur_id' =>1,
        'adresseemail_id' =>1,
        'statut_id' =>1,
    ];
});
