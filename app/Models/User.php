<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'login', 'password',
        'name', 'surname', 'patronymic',
        'email', 'phone','birthday',
        'department_id', 'function_id', 'start_work', 'status_id', 'status_at',
        'permissions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'login' => 'string',
            'name' => 'string',
            'surname' => 'string',
            'patronymic' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'birthday' => 'date',
            'department_id' => 'integer',
            'function_id' => 'integer',
            'start_work' => 'date',
            'status_id' => 'integer',
            'status_at' => 'datetime',
            'permissions' => 'array',
            'password' => 'hashed',
            'deleted_at' => 'datetime',
        ];
    }
}
