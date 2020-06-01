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
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'location_id' => 1,
            'group_id' => 1,
            'section_id' => 1,
            'teacher_id' => 1,
            'set_id' => rand(1, 4),
            'phone_number' => '+8801740-915311'
        ]);
        factory(\App\Student::class, 119)->create(['teacher_id' => 1]);
    }
}
