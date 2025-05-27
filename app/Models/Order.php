<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use softDeletes, HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'payment_id',
        'delivery_id',
        'delivery_address',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [];

    protected function casts(): array
    {
        return [
            'client_id' => 'integer',
            'user_id' => 'integer',
            'payment_id' => 'integer',
            'delivery_id' => 'integer',
            'delivery_address' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Получить клиента.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Получить пользователя.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Получить способ оплаты.
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Получить способ доставки.
     */
    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

    /**
     * Получить все статусы заказа.
     */
    public function statuses()
    {
        return $this->belongsToMany(Status::class, 'order_statuses', 'order_id', 'status_id');
    }
    public function orderStatuses(): HasMany
    {
        return $this->hasMany(OrderStatus::class);
    }

    /**
     * Получить последний статус заказа.
     */
    public function lastStatus()
    {
        return $this->belongsToMany(Status::class, 'order_statuses', 'order_id', 'status_id')
            ->withPivot('created_at')
            ->latest()
            ->limit(1);
    }

    /**
     * Получить все автомобили заказа.
     */
    public function cars()
    {
        return $this->belongsToMany(Car::class, 'order_cars', 'order_id', 'car_id');
    }
    public function orderCars(): HasMany
    {
        return $this->hasMany(OrderCar::class);
    }
}
