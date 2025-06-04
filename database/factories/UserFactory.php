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
        // Разрешения для администратора
        $userPermissions = [
            'Tabs' => [
                [
                    'Name' => 'user',
                    'RusName' => 'Пользователь',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'order',
                    'RusName' => 'Заказы',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'report',
                    'RusName' => 'Отчеты',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'setting',
                    'RusName' => 'Настройки',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'dict',
                    'RusName' => 'Словари',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ]
            ],
            'Directories' => [
                // ЗАКАЗЫ
                [
                    'Name' => 'Order',
                    'RusName' => 'Заказы',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'Client',
                    'RusName' => 'Клиенты',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'Delivery',
                    'RusName' => 'Типы Доставки',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'Payment',
                    'RusName' => 'Типы Оплаты',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'OrderStatus',
                    'RusName' => 'Статусы заказа',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                // ТРАНСПОРТ
                [
                    'Name' => 'Car',
                    'RusName' => 'Автомобили',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'CarMark',
                    'RusName' => 'Марки',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'CarModel',
                    'RusName' => 'Модели',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'CarCountry',
                    'RusName' => 'Страны',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'CarType',
                    'RusName' => 'Типы кузова',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'CarColor',
                    'RusName' => 'Цвета',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'CarMarkModelCountry',
                    'RusName' => 'Марка - Модель',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                // ПОЛЬЗОВАТЕЛИ
                [
                    'Name' => 'User',
                    'RusName' => 'Сотрудники',
                    'Permissions' => ['Read' => true, 'Write' => false]
                ],
                [
                    'Name' => 'UserDepartment',
                    'RusName' => 'Отделы',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'UserPosition',
                    'RusName' => 'Должности',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'UserStatus',
                    'RusName' => 'Статусы',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ],
                [
                    'Name' => 'UserDepartmentPosition',
                    'RusName' => 'Отдел - Должность',
                    'Permissions' => ['Read' => false, 'Write' => false]
                ]
            ]
        ];

        // Русская локаль для фейковых данных
        $faker = \Faker\Factory::create('ru_RU');

        // Выбираем случайную пару [department_id, position_id] из UserDepartmentPositionSeeder
        $departmentPosition = new UserDepartmentPositionSeeder();
        $pair = fake()->randomElement($departmentPosition->items);

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
            'permissions' => $userPermissions,
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
