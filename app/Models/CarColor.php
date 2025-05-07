<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarColor extends Model
{
    protected $fillable = [
        'color_name', 'delete',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'delete',
    ];

    protected function casts(): array
    {
        return [
            'color_name' => 'string',
            'delete' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Cars::class, 'color_id');
    }
}
