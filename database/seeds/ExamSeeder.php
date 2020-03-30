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
        factory(\App\Exam::class)->create(['name' => 'APTIS model test', 'slug' => 'aptis-model-test']);
//        factory(\App\Exam::class)->create();
    }
}
