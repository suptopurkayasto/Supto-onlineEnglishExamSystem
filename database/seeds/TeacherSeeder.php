<?php

use Illuminate\Database\Seeder;
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
        \App\Teacher::create([
            'name' => 'Teacher Supto Purkayasto',
            'email' => 'password@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$YOJLRKdEMDxCxu6UnNgiWOEb5aIfeE3CarRvpLd6za07d6sYT9gGG', // password
            'remember_token' => Str::random(10),
        ]);
        factory(\App\Teacher::class, 2)->create();
    }
}
