<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Vocabulary\Definition\DefinitionOption;
use Faker\Generator as Faker;

$factory->define(DefinitionOption::class, function (Faker $faker) {
    return [
        'exam_id' => config('app.factory.exam.id'),
        'set_id' => 1,
        'options' => $faker->word
    ];
});
