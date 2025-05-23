<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDepartmentPosition extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'department_id', 'position_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'department_id' => 'integer',
            'position_id' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Получить название департамента.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(UserDepartment::class);
    }

    /**
     * Получить название должности.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(UserPosition::class);
    }
}
