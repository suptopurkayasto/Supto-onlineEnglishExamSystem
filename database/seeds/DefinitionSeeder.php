<?php

use Illuminate\Database\Seeder;

class DefinitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($set = 1; $set <= 4; $set++) {
            for ($number = 1; $number <= 5; $number++) {
                factory(\App\Model\Vocabulary\Definition\Definition::class)->create(['set_id' => $set, 'definition_option_id' => $number]);
            }
            factory(\App\Model\Vocabulary\Definition\DefinitionOption::class, 10)->create(['set_id' => $set]);
        }
    }
}
