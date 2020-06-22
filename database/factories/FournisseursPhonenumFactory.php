<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FournisseursPhonenum;
use Faker\Generator as Faker;

$factory->define( App\FournisseursPhonenum::class, function (Faker $faker) {
    return [
        'rang' => $faker->numberBetween($min = 1, $max = 15),
        'fournisseur_id' => $faker->numberBetween($min = 1, $max = 50),
        'phonenum_id' => $faker->numberBetween($min = 1, $max = 80),
        'statut_id' => 1,

    ];
});
