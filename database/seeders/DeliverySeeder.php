<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=DeliverySeeder
        $deliveries = [
            'Самовывоз',
            'Доставка до клиента',
            'Доставка до ТК',
        ];
        $data = [];

        foreach ($deliveries as $delivery) {
            $data[] = [
                'delivery_name' => $delivery,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('deliveries')
            ->insertOrIgnore($data);
    }
}
