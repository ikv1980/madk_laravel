<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarCountry extends Model
{
    protected $fillable = [
        'country_name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'country_name' => 'string',
            'delete' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Cars::class, 'country_id');
    }
}
