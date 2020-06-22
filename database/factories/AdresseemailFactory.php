<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Adresseemail;
use Faker\Generator as Faker;

$factory->define(App\Adresseemail::class, function (Faker $faker) {
    return [

        'email' => $faker->unique()->safeEmail,
        'statut_id' => 1,
    ];
});
