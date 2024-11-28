<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Course;
use App\Models\Professor;

class CommissionsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $courseIds = Course::pluck('id')->toArray();
        $professorIds = Professor::pluck('id')->toArray();

        foreach (range(1, 30) as $index) {
            DB::table('commissions')->insert([
                'room' => 'Room ' . $faker->numberBetween(1, 10),
                'schedule' => $faker->time('H:i') . ' - ' . $faker->time('H:i', '+2 hours'),
                'course_id' => $faker->randomElement($courseIds),
                'professor_id' => $faker->randomElement($professorIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
