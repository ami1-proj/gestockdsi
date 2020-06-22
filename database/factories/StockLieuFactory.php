<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\StockLieu;
use Faker\Generator as Faker;

$factory->define( App\StockLieu::class, function (Faker $faker) {
    return [
        'nom' => $faker->streetName,
        'statut_id' => 1,
    ];
});

