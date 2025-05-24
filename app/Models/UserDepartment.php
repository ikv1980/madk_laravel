<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDepartment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'department_name', 'department_description', 'department_mail',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'department_name' => 'string',
            'department_description' => 'string',
            'department_mail' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'department_id');
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(UserPosition::class, 'user_department_positions', 'department_id', 'position_id');
    }
}
