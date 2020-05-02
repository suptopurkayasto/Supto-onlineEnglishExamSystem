<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Writing\FormalEmail\FormalEmail;
use Faker\Generator as Faker;

$factory->define(FormalEmail::class, function (Faker $faker) {
    return [
        'exam_id' => config('app.factory.exam.id'),
        'set_id' => 1,
        'topic' => $faker->sentence,
        'received_email' => $faker->paragraph(5)
    ];
});
