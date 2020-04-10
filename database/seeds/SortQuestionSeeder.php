<?php

use Illuminate\Database\Seeder;

class SortQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($set = 1; $set <= 4; $set++) {
            for ($question = 1; $question <= 7; $question++) {
                factory(\App\Model\Writing\SortQuestion::class)->create(['set_id' => $set]);
            }
        }
    }
}
