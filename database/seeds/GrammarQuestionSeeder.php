<?php

use Illuminate\Database\Seeder;

class GrammarQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($gqs = 1; $gqs <= 4; $gqs++) {
            for ($gq = 0; $gq < 25; $gq++) {
                factory(\App\Model\Grammar\Grammar::class)->create(['question_set_id' => $gqs]);
            }
        }

    }
}
