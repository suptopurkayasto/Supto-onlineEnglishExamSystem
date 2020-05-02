<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Vocabulary\Combination\CombinationOption;
use Faker\Generator as Faker;

$factory->define(CombinationOption::class, function (Faker $faker) {
    return [
        'exam_id' => config('app.factory.exam.id'),
        'set_id' => 1,
        'options' => $faker->word
    ];
});
