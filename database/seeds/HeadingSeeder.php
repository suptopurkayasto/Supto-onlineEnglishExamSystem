<?php

use Illuminate\Database\Seeder;

class HeadingSeeder extends Seeder
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
                factory(\App\Model\Reading\Heading\Heading::class)->create(['question_set_id' => $set, 'heading_option_id' => $number]);
            }
            factory(\App\Model\Reading\Heading\HeadingOption::class, 10)->create(['question_set_id' => $set]);
        }
    }
}
