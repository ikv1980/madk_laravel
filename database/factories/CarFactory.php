<?php

namespace Database\Factories;

use App\Models\CarColor;
use App\Models\CarMarkModelCountry;
use App\Models\CarType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mark_model_country_id' => CarMarkModelCountry::inRandomOrder()->value('id'),
            'type_id' => CarType::inRandomOrder()->value('id'),
            'color_id' => CarColor::inRandomOrder()->value('id'),
            'vin' => strtoupper(
                collect(range(1, 17))
                    ->map(fn() => fake()->randomElement(str_split('ABCDEFGHJKLMNPRSTUVWXYZ0123456789')))
                    ->implode('')
            ),
            'pts' => sprintf('%02dT%s%06d',
                fake()->numberBetween(10, 99),
                strtoupper(fake()->randomLetter()),
                fake()->numberBetween(100000, 999999)
            ),
            'date_at' => fake()->dateTimeBetween('-5 years', 'now'),
            'price' => fake()->numberBetween(10, 50) * 100000,
            'block' => fake()->boolean(20), // 20% вероятности блокировки
        ];
    }
}
