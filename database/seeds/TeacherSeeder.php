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
                $teacher->students()->save(factory(\App\Student::class)->make(['section_id' => '1', 'group_id' => 1]));
                $teacher->students()->save(factory(\App\Student::class)->make(['section_id' => '2', 'group_id' => 2]));
                $teacher->students()->save(factory(\App\Student::class)->make(['section_id' => '3', 'group_id' => 1]));
                $teacher->students()->save(factory(\App\Student::class)->make(['section_id' => '4', 'group_id' => 2]));
        });
    }
}
