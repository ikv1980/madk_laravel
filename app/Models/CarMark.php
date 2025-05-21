<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarMark extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'mark_name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'mark_name' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Получить все автомобили для этой модели.
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'mark_id');
    }

    /**
     * Получить все связи с моделями и странами для этой марки.
     */
    public function markModelCountries(): HasMany
    {
        return $this->hasMany(CarMarkModelCountry::class, 'mark_id');
    }
}
