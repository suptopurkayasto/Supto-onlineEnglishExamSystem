<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Writing\InformalEmail\InformalEmail;
use Faker\Generator as Faker;

$factory->define(InformalEmail::class, function (Faker $faker) {
    return [
        'exam_id' => config('app.factory.exam.id'),
        'set_id' => 1,
        'topic' => $faker->paragraph
    ];
});
