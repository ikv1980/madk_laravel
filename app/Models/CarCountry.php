<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarCountry extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'country_name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'country_name' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Получить все автомобили для этой страны.
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'country_id');
    }

    /**
     * Получить все связи с моделями и марками для этой страны.
     */
    public function markModelCountries(): HasMany
    {
        return $this->hasMany(CarMarkModelCountry::class, 'country_id');
    }
}
