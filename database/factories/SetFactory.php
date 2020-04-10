<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Set;
use Faker\Generator as Faker;

$factory->define(Set::class, function (Faker $faker) {
    return [
        'name' => $faker->randomLetter
    ];
});
