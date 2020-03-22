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
        factory(\App\Location::class, 2)->create()->each(function ($location) {
            $location->students()->save(factory(\App\Student::class)->make(['section_id' => 1, 'group_id' => 1]));
        });
    }
}
