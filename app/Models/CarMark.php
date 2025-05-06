<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarMark extends Model
{
    protected $fillable = [
        'mark_name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'mark_name' => 'string',
            'deleted' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
