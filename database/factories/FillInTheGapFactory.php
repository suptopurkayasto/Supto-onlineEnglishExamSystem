<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Vocabulary\FillInTheGap\FillInTheGap;
use Faker\Generator as Faker;

$factory->define(FillInTheGap::class, function (Faker $faker) {
    return [
        'exam_id' => 1,
        'set_id' => 1,
        'sentence' => $faker->sentence,
        'fill_in_the_gap_option_id' => 1
    ];
});
