<?php

use Illuminate\Database\Seeder;

class QuestionSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\QuestionSet::create(['name' => 'A']);
        \App\QuestionSet::create(['name' => 'B']);
        \App\QuestionSet::create(['name' => 'C']);
        \App\QuestionSet::create(['name' => 'D']);
//        factory(\App\QuestionSet::class, 5)->create();
    }
}
