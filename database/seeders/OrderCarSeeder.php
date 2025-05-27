<?php

namespace Database\Seeders;

use App\Models\OrderCar;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=OrderCarSeeder

        // Создаем данные через фабрику, но не сохраняем сразу
        $data = OrderCar::factory(20)->make()->toArray();

        // Добавляем created_at и updated_at в каждую запись
        $now = Carbon::now();
        foreach ($data as &$row) {
            $row['created_at'] = $now;
            $row['updated_at'] = $now;
        }

        // Вставляем все записи, игнорируя дубликаты
        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('order_cars')
            ->insertOrIgnore($data);
    }
}
