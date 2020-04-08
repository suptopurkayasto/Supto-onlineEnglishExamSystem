<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Reading\Heading\HeadingOption;
use Faker\Generator as Faker;

$factory->define(HeadingOption::class, function (Faker $faker) {
    return [
        'exam_id' => 1,
        'question_set_id' => 1,
        'headings' => $faker->sentence
    ];
});
