<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => 'suptopurkayasto@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$F7vBAxMetBW0oYHdNTFhl.jBWrNXT31akI5m4T9MVbq9I8d5xI5ce', // suptopurkayasto@gmail.com
        'remember_token' => Str::random(10),
    ];
});
