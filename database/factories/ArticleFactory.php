<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define( App\Article::class, function (Faker $faker) {
    return [
    	'reference' => Str::random($faker->numberBetween($min = 10, $max = 30)),
        'marque_article_id' => $faker->numberBetween($min = 1, $max = 6),
        'date_livraison' => now(),
        'type_article_id' => $faker->numberBetween($min = 1, $max = 19),
        'fournisseur_id' => $faker->numberBetween($min = 1, $max = 20),
        'etat_article_id' => 1,
        'statut_id' => 1,
    ];
});
