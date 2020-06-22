<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'intitule' => $faker->name,
        'employe_responsable_id' => 1,
        'division_id' => 1,
        'statut_id' => 1,  
    ];
});
