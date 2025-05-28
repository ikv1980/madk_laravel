<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status_name', 'status_description', 'status_number'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'status_name' => 'string',
            'status_description' => 'string',
            'status_number' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Получить все заказы с указанным статусом.
     */
    public function orders()
    {
        return $this
            ->belongsToMany(Order::class, 'order_statuses', 'status_id', 'order_id')
            ->withTimestamps();
    }
}
