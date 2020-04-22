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
        // Set A
        for ($number = 1; $number <= 5; $number++) {
            factory(\App\Model\Vocabulary\FillInTheGap\FillInTheGap::class)->create(['set_id' => 1, 'fill_in_the_gap_option_id' => $number]);
        }
        factory(\App\Model\Vocabulary\FillInTheGap\FillInTheGapOption::class, 10)->create(['set_id' => 1]);


        // Set B
        for ($number = 11; $number <= 15; $number++) {
            factory(\App\Model\Vocabulary\FillInTheGap\FillInTheGap::class)->create(['set_id' => 2, 'fill_in_the_gap_option_id' => $number]);
        }
        factory(\App\Model\Vocabulary\FillInTheGap\FillInTheGapOption::class, 10)->create(['set_id' => 2]);


        // Set C
        for ($number = 21; $number <= 25; $number++) {
            factory(\App\Model\Vocabulary\FillInTheGap\FillInTheGap::class)->create(['set_id' => 3, 'fill_in_the_gap_option_id' => $number]);
        }
        factory(\App\Model\Vocabulary\FillInTheGap\FillInTheGapOption::class, 10)->create(['set_id' => 3]);


        // Set D
        for ($number = 31; $number <= 35; $number++) {
            factory(\App\Model\Vocabulary\FillInTheGap\FillInTheGap::class)->create(['set_id' => 4, 'fill_in_the_gap_option_id' => $number]);
        }
        factory(\App\Model\Vocabulary\FillInTheGap\FillInTheGapOption::class, 10)->create(['set_id' => 4]);
    }
}
