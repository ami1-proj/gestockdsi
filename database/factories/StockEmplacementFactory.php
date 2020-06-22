<?php

use Faker\Generator as Faker;

$factory->define(App\StockEmplacement::class, function (Faker $faker) {
   return [
        'emplacement' => $faker->name,
    ];
});
