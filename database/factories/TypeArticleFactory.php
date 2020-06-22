<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypeArticle;
use Faker\Generator as Faker;

$factory->define(App\TypeArticle::class, function (Faker $faker) {
    return [
        'libelle' => $faker->name,
        'description' => $faker->text,
        'image' => 'null',
        'statut_id' => 1,
    ];
});
