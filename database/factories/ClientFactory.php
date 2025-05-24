<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
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
            'client_name' => $faker->firstName() . ' ' . $faker->lastName,
            'client_mail' => $faker->unique()->safeEmail(),
            'client_phone' => '+79' . $faker->numerify('#########'),
            'client_address' => $faker->address(),
            'client_add_data' => $faker->realText(50),
            'client_status' => $faker->boolean(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
