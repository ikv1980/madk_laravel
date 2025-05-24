<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=StatusSeeder
        $statuses = [
            ['Создан','При создании заказа (клиентом)'],
            ['В работе','При создании заказа или взятии его в работу (менеджером)'],
            ['Подтвержден','При подтверждении наличия товара на складе (менеджером)'],
            ['Отменен','При отмене заказа (менеджером)'],
            ['Выполнен','При выполнении заказа (менеджером)'],
        ];
        $data = [];
        $i = 0;

        foreach ($statuses as $status) {
            $data[] = [
                'status_name' => $status[0],
                'status_description' => $status[1],
                'status_number' => ++$i,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('statuses')
            ->insertOrIgnore($data);
    }
}
