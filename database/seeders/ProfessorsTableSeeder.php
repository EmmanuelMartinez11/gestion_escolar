<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProfessorsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('professors')->insert([
                'name' => $faker->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
