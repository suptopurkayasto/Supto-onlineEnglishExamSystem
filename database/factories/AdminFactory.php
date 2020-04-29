<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => 'Supto Purkayasto',
        'email' => 'suptopurkayasto@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$lo.SFkxHGa4054qLutWLRuzseNob/1G.3cn.1tBu1x4JZkJpMoBpm', // suptopurkayasto@gmail.com
        'remember_token' => Str::random(10),
    ];
});
