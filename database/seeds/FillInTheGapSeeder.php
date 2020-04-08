<?php

use Illuminate\Database\Seeder;

class FillInTheGapSeeder extends Seeder
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
                factory(\App\Model\Vocabulary\FillInTheGap\FillInTheGap::class)->create(['question_set_id' => $set, 'fill_in_the_gap_option_id' => $number]);
            }
            factory(\App\Model\Vocabulary\FillInTheGap\FillInTheGapOption::class, 10)->create(['question_set_id' => $set]);
        }
    }
}
