<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MarqueArticle;
use Faker\Generator as Faker;

$factory->define(App\MarqueArticle::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
       
        'statut_id' => 1,
    
    ];
});
