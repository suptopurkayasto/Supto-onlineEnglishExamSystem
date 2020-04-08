<?php

use Illuminate\Database\Seeder;

class RearrangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($set = 1; $set <= 4; $set++) {
                factory(\App\Model\Reading\Rearrange\Rearrange::class)->create(['question_set_id' => $set]);
        }
    }
}
