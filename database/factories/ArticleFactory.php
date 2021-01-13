<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $tag = 'shuffle';
    return [
        'image' => '/article.jpg',
        'preview' => '/preview.jpg',
        'theme' => $faker->sentence($nbWords = 3, $variableNbWords = false),
        'description' => $faker->sentence(),
        'body' => $faker->paragraphs($nb = 9, $asText = true),
        'likes' => $faker->randomDigit(),
        'views' => $faker->randomDigit(),
        'created_at' => $faker->dateTime($max = 'now'),
        'updated_at' => $faker->dateTime($max = 'now')
    ];
});
