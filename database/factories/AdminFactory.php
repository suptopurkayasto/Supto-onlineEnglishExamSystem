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
        'password' => '$2y$10$WKcMLlxMX7EP7RmU97UVQ.WhoOwJzB7.UNbw.RSSHAcJ2gSlX4QXS', // developersupto@gmail.com
        'remember_token' => Str::random(10),
    ];
});
