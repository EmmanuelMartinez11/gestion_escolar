<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SubjectsTableSeeder::class,
            StudentsTableSeeder::class,
            ProfessorsTableSeeder::class,
            CoursesTableSeeder::class,
            CommissionsTableSeeder::class,
            CourseStudentSeeder::class,
        ]);
    }
}
