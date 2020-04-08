<?php

use Illuminate\Database\Seeder;

class SynonymSeeder extends Seeder
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
                factory(\App\Model\Vocabulary\Synonym\Synonym::class)->create(['question_set_id' => $set, 'synonym_option_id' => $number]);
            }
            factory(\App\Model\Vocabulary\Synonym\SynonymOption::class, 10)->create(['question_set_id' => $set]);

        }
    }
}
