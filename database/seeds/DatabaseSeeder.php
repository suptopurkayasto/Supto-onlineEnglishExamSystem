<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(GroupSeeder::class);

        $this->call(LocationSeeder::class);

//        $this->call(TeacherSeeder::class);
    }
}
