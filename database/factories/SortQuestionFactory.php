<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Writing\SortQuestion;
use Faker\Generator as Faker;

$factory->define(SortQuestion::class, function (Faker $faker) {
    return [
        'exam_id' => 1,
        'question_set_id' => 1,
        'question' => $faker->sentence . '?'
    ];
});
