<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Разрешения для администратора
        $adminPermissions = [
            'Tabs' => [
                [
                    'Name' => 'user',
                    'RusName' => 'Пользователь',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'order',
                    'RusName' => 'Заказы',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'report',
                    'RusName' => 'Отчеты',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'setting',
                    'RusName' => 'Настройки',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'dict',
                    'RusName' => 'Словари',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ]
            ],
            'Directories' => [
                // ЗАКАЗЫ
                [
                    'Name' => 'Order',
                    'RusName' => 'Заказы',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'Client',
                    'RusName' => 'Клиенты',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'Delivery',
                    'RusName' => 'Типы Доставки',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'Payment',
                    'RusName' => 'Типы Оплаты',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'OrderStatus',
                    'RusName' => 'Статусы заказа',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                // ТРАНСПОРТ
                [
                    'Name' => 'Car',
                    'RusName' => 'Автомобили',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'CarMark',
                    'RusName' => 'Марки',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'CarModel',
                    'RusName' => 'Модели',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'CarCountry',
                    'RusName' => 'Страны',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'CarType',
                    'RusName' => 'Типы кузова',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'CarColor',
                    'RusName' => 'Цвета',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'CarMarkModelCountry',
                    'RusName' => 'Марка - Модель',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                // ПОЛЬЗОВАТЕЛИ
                [
                    'Name' => 'User',
                    'RusName' => 'Сотрудники',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'UserDepartment',
                    'RusName' => 'Отделы',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'UserPosition',
                    'RusName' => 'Должности',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'UserStatus',
                    'RusName' => 'Статусы',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ],
                [
                    'Name' => 'UserDepartmentPosition',
                    'RusName' => 'Отдел - Должность',
                    'Permissions' => ['Read' => true, 'Write' => true]
                ]
            ]
        ];

        // Преобразуем массив в JSON
        $adminPermissionsJson = json_encode($adminPermissions, JSON_UNESCAPED_UNICODE);

        // Создаем администратора вручную
        $data =
            [
                'login' => 'admin',
                //'password' => Hash::make('kostik80'),
                'password' => 'R7F+D8pq3nvgpdoCFMAbV90hfNjQQBNCxuq2OHqxZ20=',
                'firstname' => 'Администратор',
                'surname' => 'Системы',
                'patronymic' => '',
                'email' => 'admin@admin.com',
                'phone' => '+79855098044',
                'birthday' => '1980-03-31',
                'department_id' => 6,
                'position_id' => 9,
                'start_work' => now()->format('Y-m-d'),
                'status_id' => 1,
                'status_at' => now()->format('Y-m-d'),
                'permissions' => $adminPermissionsJson
            ];
        // Вызов сидера отдельно
        // php artisan db:seed --class=AdminSeeder

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('users')
            ->insertOrIgnore($data);
    }
}
