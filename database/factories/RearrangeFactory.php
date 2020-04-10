<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Reading\Rearrange\Rearrange;
use Faker\Generator as Faker;

$factory->define(Rearrange::class, function (Faker $faker) {
    return [
        'exam_id' => 1,
        'set_id' => 1,
        'line_1' => $faker->sentence,
        'line_2' => $faker->sentence,
        'line_3' => $faker->sentence,
        'line_4' => $faker->sentence,
        'line_5' => $faker->sentence,
        'line_6' => $faker->sentence,
        'line_7' => $faker->sentence,
    ];
});
