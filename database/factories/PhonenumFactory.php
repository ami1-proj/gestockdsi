<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Phonenum;
use Faker\Generator as Faker;

$factory->define( App\Phonenum::class, function (Faker $faker) {
    return [
        'numero' => $faker->phoneNumber,
        'statut_id' => 1,
    ];
});
