<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=TypeSeeder
        $types = ['седан','купе','хэтчбек','лифтбек','фастбэк','универсал','кроссовер','внедорожник','пикап','легковой фургон','минивэн','компактвэн','микровэн','кабриолет','родстер','ландо','лимузин'];
        $data = [];

        foreach ($types as $type) {
            $data[] = ['type_name' => $type,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('car_types')
            ->insertOrIgnore($data);
    }
}
