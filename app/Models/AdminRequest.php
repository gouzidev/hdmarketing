<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminRequest extends Model
{
    protected $fillable = [
        'user_id',
        'admin_id',
        'status',
        'description',
        'created_at',
        'processed_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function adminUser() : BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);

    }
}
