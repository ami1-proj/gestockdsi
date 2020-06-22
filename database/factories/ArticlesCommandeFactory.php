<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ArticlesCommande;
use Faker\Generator as Faker;

$factory->define(ArticlesCommande::class, function (Faker $faker) {
    return [
        'objet_commande' => $faker->dateTime,
        'description_commande' => $faker->dateTime,
        'etat_commande_id' => 1,
        'article_id' => 1,
        'employe_id' => 1,  
        'statut_id' => 1,  
    ];
});
