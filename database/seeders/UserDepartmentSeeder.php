<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Вызов сидера отдельно
        // php artisan db:seed --class=UserDepartmentSeeder
        $departments = [
            'Дирекция',
            'Бухгалтерия',
            'Отдел продаж',
            'Отдел маркетинга',
            'IT отдел',
            'Склад',];
        $data = [];

        foreach ($departments as $department) {
            $data[] = [
                'department_name' => $department,
                'department_description' => fake()->realText(50),
                'department_mail' => fake()->unique()->safeemail(),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('user_departments')
            ->insertOrIgnore($data);
    }
}
