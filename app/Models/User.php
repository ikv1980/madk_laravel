<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes, HasFactory, HasApiTokens;

    protected $fillable = [
        'login', 'password',
        'name', 'surname', 'patronymic',
        'email', 'phone', 'birthday',
        'department_id', 'position_id', 'start_work', 'status_id', 'status_at',
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
            'password' => 'hashed',
            'name' => 'string',
            'surname' => 'string',
            'patronymic' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'birthday' => 'date',
            'department_id' => 'integer',
            'position_id' => 'integer',
            'start_work' => 'date',
            'status_id' => 'integer',
            'status_at' => 'date',
            'permissions' => 'array',

            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Получить департамент.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(UserDepartment::class);
    }

    /**
     * Получить должность.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(UserPosition::class);
    }

    /**
     * Получить статус.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(UserStatus::class);
    }
}
