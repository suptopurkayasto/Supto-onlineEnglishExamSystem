<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => 'Supto Purkayasto',
        'email' => 'developersuptop@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$HqBxYbJc/fkW/3GzuSurvenpOhmVXmN.cBhOEOrbDodc7M0KwOv9i', // developersuptop@gmail.com
        'remember_token' => Str::random(10),
    ];
});
