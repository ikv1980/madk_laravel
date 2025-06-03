<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDepartmentPositionSeeder extends Seeder
{
    public array $items = [
        ['1', '1'], ['1', '2'], ['1', '3'], ['2', '4'], ['2', '5'], ['2', '13'], ['3', '6'], ['3', '7'], ['3', '8'], ['4', '6'], ['5', '10'], ['4', '12'], ['4', '13'], ['5', '6'], ['5', '10'], ['6', '6'], ['6', '9'], ['6', '11'], ['7', '6'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=UserDepartmentPositionSeeder
        $data = [];

        foreach ($this->items as $item) {
            $data[] = [
                'department_id' => $item[0],
                'position_id' => $item[1],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('user_department_positions')
            ->insertOrIgnore($data);
    }
}
