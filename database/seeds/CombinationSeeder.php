<?php

use Illuminate\Database\Seeder;

class CombinationSeeder extends Seeder
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
                factory(\App\Model\Vocabulary\Combination\Combination::class)->create(['set_id' => $set, 'combination_option_id' => $number]);
            }
            factory(\App\Model\Vocabulary\Combination\CombinationOption::class, 10)->create(['set_id' => $set]);
        }
    }
}
