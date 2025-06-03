<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'mark_id',
        'model_id',
        'country_id',
        'type_id',
        'color_id',
        'vin',
        'pts',
        'date_at',
        'price',
        'block',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'mark_id' => 'integer',
            'model_id' => 'integer',
            'country_id' => 'integer',
            'type_id' => 'integer',
            'color_id' => 'integer',
            'vin' => 'string',
            'pts' => 'string',
            'price' => 'float',
            'block' => 'integer',
            'date_at' => 'date',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Получить марку авто.
     */
    public function mark(): BelongsTo
    {
        return $this->belongsTo(CarMark::class);
    }

    /**
     * Получить модель авто.
     */
    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    /**
     * Получить страну авто.
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

    /**
     * Получить все заказы в которых есть этот автомобиль.
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Car::class, 'order_cars', 'car_id', 'order_id');
    }
    public function orderCars(): HasMany
    {
        return $this->hasMany(OrderCar::class);
    }
}
