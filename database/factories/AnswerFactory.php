<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    $tags = [
        'Diet',
        'LifeStyle',

        // Product Tags
        'Pain',
        'Energy',
        'Sleep',
        'Health',
    ];

    return [
        'title' => $faker->sentence(),
        'subtitle' => $faker->sentence(),
        'tag' => $tags[ $faker->numberBetween(0, count($tags) - 1) ],
        'is_selected' => $faker->boolean(),
    ];
});
