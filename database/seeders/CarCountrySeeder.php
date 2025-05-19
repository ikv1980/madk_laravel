<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=CarCountrySeeder
        $countries = ['Австралия','Австрия','Беларусь','Бразилия','Великобритания','Вьетнам','Германия','Дания','Израиль','Индия','Иран','Испания','Италия','Китай','Латвия','Малайзия','Мексика','Нидерланды','Норвегия','Объединённые Арабские Эмираты','Польша','Россия','Румыния','Северная Америка','Сербия','США','Таиланд','Тайвань','Турция','Узбекистан','Украина','Франция','Хорватия','Чехия','Швейцария','Швеция','Южная Корея','Япония'];
        $data = [];

        foreach ($countries as $country) {
            $data[] = ['country_name' => $country,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('car_countries')
            ->insertOrIgnore($data);
    }
}
