<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Vocabulary\Synonym\SynonymOption;
use Faker\Generator as Faker;

$factory->define(SynonymOption::class, function (Faker $faker) {
    return [
        'exam_id' => 1,
        'question_set_id' => 1,
        'options' => $faker->word
    ];
});
