<?php

/** @var Factory $factory */

use App\Model\Grammar\Grammar;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Grammar::class, function (Faker $faker) {
    $words = [$faker->word, $faker->word, $faker->word];
    return [
        'exam_id' => config('app.factory.exam.id'),
        'set_id' => $faker->numberBetween(1, 4),
        'question' => $faker->sentence,
        'option_1' => $words[0],
        'option_2' => $words[1],
        'option_3' => $words[2],
        'answer' => $words[rand(0, 2)],
    ];
});
