<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserStatus extends Model
{
    protected $fillable = [
        'status_name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'delete',
    ];

    protected function casts(): array
    {
        return [
            'status_name' => 'string',
            'delete' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Cars::class, 'status_id');
    }
}
