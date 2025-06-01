<?php

namespace Database\Factories;

use Database\Seeders\UserDepartmentPositionSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Русская локаль для фейковых данных
        $faker = \Faker\Factory::create('ru_RU');

        // Выбираем случайную пару [department_id, position_id] из UserDepartmentPositionSeeder
        $departmentPositionPairs = new UserDepartmentPositionSeeder();
        $pair = fake()->randomElement($departmentPositionPairs->items);

        return [
            'login' => $this->faker->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
            'firstname' => $faker->firstNameMale(),
            'surname' => $faker->lastName(),
            'patronymic' => $faker->randomElement([
                'Сергеевич', 'Александрович', 'Иванович', 'Михайлович', 'Владимирович',
                'Алексеевич', 'Дмитриевич', 'Николаевич', 'Павлович', 'Викторович',
            ]),
            'email' => $faker->unique()->safeEmail(),
            'phone' => '+79' . $faker->numerify('#########'),
            'birthday' => $faker->date('Y-m-d', '-20 years'),
            'department_id' => $pair[0],
            'position_id' => $pair[1],
            'start_work' => $faker->date('Y-m-d', 'now'),
            'status_id' => $faker->numberBetween(1, 4),
            'status_at' => $faker->date('Y-m-d', 'now'),
            'permissions' => $faker->randomElement([
                ['view_users' => 'edit_users'],
                ['view_reports' => 'edit_reports'],
                ['view_users' => 'read_only', 'view_reports' => 'read_only'],
                [],
            ]),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
