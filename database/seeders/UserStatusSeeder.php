<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=UserStatusSeeder
        $statuses = ['работает', 'уволен', 'в отпуске', 'на больничном',];
        $data = [];
        $i = 1;

        foreach ($statuses as $status) {
            $data[] = [
                'status_name' => $status,
                'status_number' => $i++,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('user_statuses')
            ->insertOrIgnore($data);
    }
}
