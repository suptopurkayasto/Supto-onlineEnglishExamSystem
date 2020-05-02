<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Vocabulary\Definition\Definition;
use Faker\Generator as Faker;

$factory->define(Definition::class, function (Faker $faker) {
    return [
        'exam_id' => config('app.factory.exam.id'),
        'set_id' => 1,
        'sentence' => $faker->sentence,
        'definition_option_id' => 1
    ];
});
