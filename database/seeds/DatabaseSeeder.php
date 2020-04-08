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
        $this->call(LocationSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(QuestionSetSeeder::class);
        $this->call(StudentSeeder::class);


        $this->call(ExamSeeder::class);
        $this->call(GrammarQuestionSeeder::class);
        $this->call(DialogSeeder::class);
        $this->call(InformalEmailSeeder::class);
        $this->call(FormalEmailSeeder::class);
        $this->call(SortQuestionSeeder::class);
    }
}
