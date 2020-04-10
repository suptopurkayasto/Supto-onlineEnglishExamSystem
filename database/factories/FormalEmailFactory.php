<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Writing\FormalEmail;
use Faker\Generator as Faker;

$factory->define(FormalEmail::class, function (Faker $faker) {
    return [
        'exam_id' => 1,
        'set_id' => 1,
        'topic' => $faker->sentence,
        'received_email' => $faker->paragraph(5)
    ];
});
