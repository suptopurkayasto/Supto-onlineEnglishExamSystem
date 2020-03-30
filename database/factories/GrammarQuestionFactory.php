<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Grammar\Grammar;
use Faker\Generator as Faker;

$factory->define(Grammar::class, function (Faker $faker) {
    return [
        'exam_id' => 1,
        'question_set_id' => $faker->numberBetween(1, 4),
        'question' => $faker->sentence,
        'option_1' => $faker->word,
        'option_2' => $faker->word,
        'option_3' => $faker->word,
        'answer' => $faker->word,
    ];
});
