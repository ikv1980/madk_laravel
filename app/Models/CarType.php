<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarType extends Model
{
    protected $fillable = [
        'type_name', 'delete',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'type_name' => 'string',
            'delete' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Cars::class, 'type_id');
    }
}
