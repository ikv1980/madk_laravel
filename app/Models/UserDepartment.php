<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserDepartment extends Model
{
    protected $fillable = [
        'department_name', 'department_description','department_mail',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'department_name' => 'string',
            'department_description' => 'string',
            'department_mail' => 'string',
            'delete' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Cars::class, 'department_id');
    }
}
