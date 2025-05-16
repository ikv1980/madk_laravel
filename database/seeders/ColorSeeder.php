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
        $colors = ['белый', 'бронзовый', 'голубой', 'желтый', 'зеленый', 'золотой', 'индиго', 'коричневый', 'красный', 'оранжевый', 'розовый', 'серебрянный', 'серый', 'синий', 'сиреневый', 'фиолетовый', 'черный'];
        $data = [];

        foreach ($colors as $color) {
            $data[] = ['color_name' => $color,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('car_colors')
            ->insertOrIgnore($data);
    }
}
