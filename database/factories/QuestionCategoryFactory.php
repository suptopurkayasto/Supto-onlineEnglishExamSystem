<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\QuestionCategory;
use Faker\Generator as Faker;

$factory->define(QuestionCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
        'slug' => Str::slug($faker->words(2, true))
    ];
});
