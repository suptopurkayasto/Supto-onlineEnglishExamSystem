<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Teacher::class, 3)->create()->each(function ($teacher) {
            for ($students = 0; $students < 50; $students++) {
                $teacher->students()->save(factory(\App\Student::class)->make());
            }
        });
    }
}
