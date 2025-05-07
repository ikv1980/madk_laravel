<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserFunction extends Model
{
    protected $fillable = [
        'function_name', 'function_description', 'delete',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'function_name' => 'string',
            'function_description' => 'string',
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
