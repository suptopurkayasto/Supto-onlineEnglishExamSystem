<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Writing\Dialog\Dialog;
use Faker\Generator as Faker;

$factory->define(Dialog::class, function (Faker $faker) {
    return [
        'exam_id' => 1,
        'set_id' => 1,
        'topic' => $faker->paragraph,
        'question_1' => $faker->sentence . '?',
        'question_2' => $faker->sentence . '?',
        'question_3' => $faker->sentence . '?',
    ];
});
