<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cars extends Model
{
    protected $fillable = [
        'mark',
        'model',
        'country',
        'type',
        'color',
        'vin',
        'pts',
        'date_at',
        'price',
        'block',
        'delete',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'float',
            'block' => 'boolean',
            'delete' => 'boolean',
            'date_at' => 'date',
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
     * Получить тип кузова.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(CarType::class);
    }

    /**
     * Получить цвет кузова.
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(CarColor::class);
    }

    /**
     * Получить фотографии авто.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(CarPhoto::class, 'car_id');
    }
}
