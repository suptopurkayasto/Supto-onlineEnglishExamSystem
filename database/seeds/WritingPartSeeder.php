<?php

use Illuminate\Database\Seeder;

class WritingPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Writing\WritingPart::create(['name' => 'Sort Answer', 'slug' => 'sort-answer']);
        \App\Model\Writing\WritingPart::create(['name' => 'Dialog', 'slug' => 'dialog']);
        \App\Model\Writing\WritingPart::create(['name' => 'Formal Email', 'slug' => 'formal-email']);
        \App\Model\Writing\WritingPart::create(['name' => 'Informal Email', 'slug' => 'informal-email']);
    }
}
