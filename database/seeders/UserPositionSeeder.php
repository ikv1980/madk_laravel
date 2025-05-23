<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=UserPositionSeeder
        $positions = [
            'Генеральный директор',
            'Коммерческий директор',
            'Технический директор',
            'Главный бухгалтер',
            'Руководитель отдела',
            'Системный администратор',
            'Руководитель группы',
            'Программист',
            'Главный бухгалтер',
            'Бухгалтер',
            'Менеджер',
            'Стажер',
        ];
        $data = [];

        foreach ($positions as $position) {
            $data[] = [
                'position_name' => $position,
                'position_description' => fake()->realText(50),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('user_positions')
            ->insertOrIgnore($data);
    }
}
