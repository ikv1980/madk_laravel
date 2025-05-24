<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\CarFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);

        $this->call([
            CarColorSeeder::class,
            CarCountrySeeder::class,
            CarMarkSeeder::class,
            CarModelSeeder::class,
            CarTypeSeeder::class,
            CarMarkModelCountrySeeder::class,
            CarSeeder::class,

            UserDepartmentSeeder::class,
            UserPositionSeeder::class,
            UserDepartmentPositionSeeder::class,
            UserStatusSeeder::class,
            UserSeeder::class,

            DeliverySeeder::class,
            PaymentSeeder::class,
            StatusSeeder::class,
            ClientSeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
            OrderCarSeeder::class,
            OrderStatusSeeder::class,
        ]);
    }
}
