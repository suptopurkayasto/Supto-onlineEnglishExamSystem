<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Writing\SortQuestion\SortQuestion;
use Faker\Generator as Faker;

$factory->define(SortQuestion::class, function (Faker $faker) {
    return [
        'exam_id' => 1,
        'set_id' => 1,
        'question' => $faker->sentence
    ];
});
