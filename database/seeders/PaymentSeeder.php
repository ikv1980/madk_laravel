<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=PaymentSeeder
        $payments = [
            'Оплата картой',
            'Оплата наличными',
            'Безналичный расчет',
        ];
        $data = [];

        foreach ($payments as $payment) {
            $data[] = [
                'payment_name' => $payment,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('payments')
            ->insertOrIgnore($data);
    }
}
