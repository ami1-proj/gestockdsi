<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Direction;
use Faker\Generator as Faker;

$factory->define(App\Direction::class, function (Faker $faker) {
    return [
        'intitule' => $faker->name,
        'employe_responsable_id' => 1,
        'statut_id' => 1,  
    ];
});
