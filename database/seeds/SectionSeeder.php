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
        \App\Section::create(['name' => 1]);
        \App\Section::create(['name' => 2]);
    }
}
