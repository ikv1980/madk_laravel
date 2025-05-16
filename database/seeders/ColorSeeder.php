<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=ColorSeeder

        $colors =[
            ['color_name' => 'цвет 1', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'цвет 2', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'цвет 3', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'цвет 4', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'цвет 5', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::connection('test_dev')->table('car_colors')->insert($colors);
    }
}
