<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=CarSeeder
        Car::factory(10)->create();
    }
}
