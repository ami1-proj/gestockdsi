<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EmployesPhonenum;
use Faker\Generator as Faker;

$factory->define(App\EmployesPhonenum::class, function (Faker $faker) {
    return [
        'rang' => $faker->numberBetween($min = 1, $max = 15),
        'employe_id' =>1,
        'Phonenum_id' =>1,
        'statut_id' =>1 ,  
         ];
});
