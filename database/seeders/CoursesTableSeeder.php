<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $subjectIds = DB::table('subjects')->pluck('id');
        foreach (range(1, 20) as $index) {
            DB::table('courses')->insert([
                'name' => $faker->sentence(2),
                'subject_id' => $faker->randomElement($subjectIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
