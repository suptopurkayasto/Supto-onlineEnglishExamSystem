<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Student::class)->create([
            'location_id' => 1,
            'group_id' => 1,
            'section_id' => 1,
            'teacher_id' => 1,
            'question_set_id' => rand(1, 4)
        ]);
    }
}
