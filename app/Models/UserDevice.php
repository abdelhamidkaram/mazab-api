<?php

namespace App\Models;

use App\Enums\DevicePlatform;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'platform',
        'is_active',
        'last_seen',
    ];

    protected $casts = [
        'last_seen' => 'datetime',
        'platform' => DevicePlatform::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
