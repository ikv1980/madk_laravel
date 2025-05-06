<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
            'deleted' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
