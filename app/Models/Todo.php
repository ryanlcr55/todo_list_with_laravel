<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static $unguarded = true;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'done_at' => 'datetime',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(TodoItem::class);
    }
}
