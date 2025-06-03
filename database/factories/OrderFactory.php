<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Delivery;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Русская локаль для фейковых данных
        $faker = \Faker\Factory::create('ru_RU');

        return [
            'client_id' => Client::where('client_status', true)->inRandomOrder()->value('id'),
            'user_id' => User::where('department_id', 4)->inRandomOrder()->value('id'),
            'payment_id' => Payment::inRandomOrder()->value('id'),
            'delivery_id' => Delivery::inRandomOrder()->value('id'),
            'delivery_address' => $faker->address(),
            'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
