<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Division;
use Faker\Generator as Faker;

$factory->define(App\Division::class, function (Faker $faker) {
    return [
        'intitule' => $faker->name,
        'employe_responsable_id' => 1,
        'direction_id' => 1,
        'statut_id' => 1,  
    ];
});   
