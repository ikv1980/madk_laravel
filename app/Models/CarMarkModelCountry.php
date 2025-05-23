<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarMarkModelCountry extends Model
{
    protected $fillable = [
        'mark_id',
        'model_id',
        'country_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'mark_id' => 'integer',
            'model_id' => 'integer',
            'country_id' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Получить марку автомобиля.
     */
    public function mark(): BelongsTo
    {
        return $this->belongsTo(CarMark::class);
    }

    /**
     * Получить модель автомобиля.
     */
    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    /**
     * Получить страну производства.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(CarCountry::class);
    }

    /**
     * Получить все автомобили этой конкретной модели.
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'car_mark_model_country_id');
    }
}
