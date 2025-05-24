<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'client_name',
        'client_email',
        'client_phone',
        'client_address',
        'client_add_data',
        'client_status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'client_name' => 'string',
            'client_email' => 'string',
            'client_phone' => 'string',
            'client_address' => 'string',
            'client_add_data' => 'string',
            'client_status' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Получить все заказы клиента.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
