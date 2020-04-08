<?php

use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Exam::class)->create(['name' => 'APTIS model test']);

        $exam = \App\Exam::find(1);
        $questionSets = \App\QuestionSet::all();
        $exam->sets()->attach($questionSets);

//        factory(\App\Exam::class)->create();
    }
}
