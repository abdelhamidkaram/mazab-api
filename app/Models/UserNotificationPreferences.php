<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotificationPreferences extends Model
{
    protected $fillable = [
        'user_id',
        'notification_type',
        'email_enabled',
        'sms_enabled',
        'push_enabled',
        'in_app_enabled',
        'enabled',
    ];
}
