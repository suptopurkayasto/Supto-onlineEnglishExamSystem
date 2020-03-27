<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Location::class)->create()->each(function ($location) {
            $location->teachers()->save(factory(\App\Teacher::class)->make(['profile_status' => true]))->each(function ($teacher) {
                $teacher->exams()->save(factory(\App\Exam::class)->make(['name' => 'APTIS model test', 'slug' => 'aptis-model-test']));
                for ($students = 0; $students < 2; $students++) {
                    $teacher->students()->save(factory(\App\Student::class)->make(['group_id' => 1, 'section_id' => 1, 'teacher_id' => 1, 'question_set_id' => random_int(1, 4)]));
                }
            });
        });
    }
}
