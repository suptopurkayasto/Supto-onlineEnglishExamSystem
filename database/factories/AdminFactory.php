<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => config('app.developer.name'),
        'email' => config('app.developer.email'),
        'email_verified_at' => now(),
        'password' => Hash::make(config('app.developer.email')),
        'remember_token' => Str::random(10),
    ];
});
