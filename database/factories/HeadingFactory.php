<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Reading\Heading\Heading;
use Faker\Generator as Faker;

$factory->define(Heading::class, function (Faker $faker) {
    return [
        'exam_id' => 1,
        'question_set_id' => 1,
        'paragraph' => $faker->paragraph,
        'heading_option_id' => 1
    ];
});
