<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserPosition extends Model
{
    protected $fillable = [
        'position_name', 'position_description', 'delete',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'delete',
    ];

    protected function casts(): array
    {
        return [
            'position_name' => 'string',
            'position_description' => 'string',
            'delete' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Cars::class, 'function_id');
    }
}
