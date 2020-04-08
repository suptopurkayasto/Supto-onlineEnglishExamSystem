<?php

use Illuminate\Database\Seeder;

class FormalEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($set = 1; $set <= 4; $set++) {
            factory(\App\Model\Writing\FormalEmail::class)->create(['question_set_id' => $set]);
        }
    }
}
