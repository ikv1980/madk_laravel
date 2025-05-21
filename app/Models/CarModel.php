<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'model_name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'model_name' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Получить все автомобили для этой марки.
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'model_id');
    }

    /**
     * Получить все связи с марками и странами для этой модели.
     */
    public function markModelCountries(): HasMany
    {
        return $this->hasMany(CarMarkModelCountry::class, 'model_id');
    }
}
