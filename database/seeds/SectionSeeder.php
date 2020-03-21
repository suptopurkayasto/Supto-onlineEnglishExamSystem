<?php

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Section::create(['name' => 'A']);
        \App\Section::create(['name' => 'B']);
        \App\Section::create(['name' => 'C']);
        \App\Section::create(['name' => 'D']);
    }
}
