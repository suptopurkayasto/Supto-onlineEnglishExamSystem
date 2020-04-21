<?php

use Illuminate\Database\Seeder;

class DialogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($set = 1; $set <= 4; $set++) {
            factory(\App\Model\Writing\Dialog\Dialog::class)->create(['set_id' => $set]);
        }
    }
}
