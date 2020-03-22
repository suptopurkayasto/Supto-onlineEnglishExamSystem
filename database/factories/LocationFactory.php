<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Location;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'name' => $faker->address,
        'slug' => Str::slug($faker->address)
    ];
});
