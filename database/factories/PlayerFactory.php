<?php

use App\Models\Player;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Player::class, function (Faker $faker) {
    $gender = ['male', 'female'][ $faker->numberBetween(0, 1) ];

    return [
        'uuid' => (string) Str::uuid(),
        'name' => $faker->name($gender),
        'gender' => $gender,
        'age' => $faker->numberBetween(18, 50),
        'city' => $faker->city,
        'mobile' => $faker->phoneNumber,
    ];
});
