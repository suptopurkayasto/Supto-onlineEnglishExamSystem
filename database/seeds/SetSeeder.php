<?php

use Illuminate\Database\Seeder;

class SetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Set::create(['name' => 'A']);
        \App\Set::create(['name' => 'B']);
        \App\Set::create(['name' => 'C']);
        \App\Set::create(['name' => 'D']);

//        factory(\App\Set::class, 5)->create();

//        \App\Set::all()->each(function ($questionSet) {
//            for ($grammarQuestionLimit = 1; $grammarQuestionLimit <= 25; $grammarQuestionLimit++) {
//                $questionSet->grammarQuestions()->save(factory(\App\Model\Grammar\Grammar::class)->make());
//            }
//        });
    }
}
