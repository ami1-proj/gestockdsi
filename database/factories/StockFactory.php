<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stock;
use Faker\Generator as Faker;

$factory->define(App\Stock::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
        'lieu_id' => 1,
        'statut_id' => 1,
    ];
});
