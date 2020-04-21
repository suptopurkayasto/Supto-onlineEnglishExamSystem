<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Vocabulary\Synonym\Synonym;
use Faker\Generator as Faker;

$factory->define(Synonym::class, function (Faker $faker) {
    return [
        'exam_id' => 1,
        'set_id' => 1,
        'word' => $faker->word,
        'synonym_option_id' => 1
    ];
});
