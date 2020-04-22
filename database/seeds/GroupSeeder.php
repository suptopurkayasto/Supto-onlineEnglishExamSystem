<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Group::create(['name' => 'A']);
        \App\Group::create(['name' => 'B']);
        \App\Group::create(['name' => 'C']);
        \App\Group::create(['name' => 'D']);
    }
}
