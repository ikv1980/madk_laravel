<?php

namespace Database\Seeders;

use App\Models\OrderCar;
use Illuminate\Database\Seeder;

class OrderCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=OrderCarSeeder
        OrderCar::factory(20)->create();
    }
}
