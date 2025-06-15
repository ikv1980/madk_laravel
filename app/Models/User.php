<?php

namespace App\Models;


use Carbon\Carbon;
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
        'firstname', 'surname', 'patronymic',
        'email', 'phone', 'birthday',
        'department_id', 'position_id', 'start_work', 'status_id', 'status_at',
        'permissions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'login' => 'string',
            'password' => 'hashed',
            'firstname' => 'string',
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

    // Полное ФИО
    public function getFullnameAttribute(): string
    {
        return trim("{$this->surname} {$this->firstname} {$this->patronymic}");
    }

    // День рождения
    public function getBirthdayAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y') : '-';
    }
    public function getBirthdayInputAttribute()
    {
        if (empty($this->attributes['birthday'])) {
            return '';
        }

        try {
            return Carbon::parse($this->attributes['birthday'])->format('Y-m-d');
        } catch (\Exception $e) {
            return '';
        }
    }

    // Дата приема на работу
    public function getStartWorkAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y') : '-';
    }
    public function getStartWorkInputAttribute()
    {
        if (empty($this->attributes['start_work'])) {
            return '';
        }

        try {
            return Carbon::parse($this->attributes['start_work'])->format('Y-m-d');
        } catch (\Exception $e) {
            return '';
        }
    }

    // Дата статуса
    public function getStatusAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y') : '-';
    }
    public function getStatusAtInputAttribute()
    {
        if (empty($this->attributes['status_at'])) {
            return '';
        }

        try {
            return Carbon::parse($this->attributes['status_at'])->format('Y-m-d');
        } catch (\Exception $e) {
            return '';
        }
    }
}
