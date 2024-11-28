<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Student;
use App\Models\Course;
use App\Models\Commission;

class CourseStudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $studentIds = Student::pluck('id')->toArray();
        $courseIds = Course::pluck('id')->toArray();
        $commissionIds = Commission::pluck('id')->toArray();

        foreach (range(1, 100) as $index) {
            DB::table('course_student')->insert([
                'student_id' => $faker->randomElement($studentIds),
                'course_id' => $faker->randomElement($courseIds),
                'commission_id' => $faker->randomElement($commissionIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
