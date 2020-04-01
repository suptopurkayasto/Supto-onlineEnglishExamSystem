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
        factory(\App\Teacher::class)->create([
            'name' => 'Supto Teacher',
            'email' => 'supto@gmail.com',
            'password' => Hash::make('supto@gmail.com'),
            'location_id' => 1,
            'profile_status' => 1,
        ]);

    }
}
