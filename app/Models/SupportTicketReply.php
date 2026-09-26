<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SupportTicketReply extends Model
{
    use HasUuids;
    protected $fillable = [
        'ticket_id',
        'user_id',
        'email',
        'body',
        'attachments_urls',
    ];

    protected $casts = [
        'attachments_urls' => 'array',
    ];

    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isAdmin(): bool
    {
        return $this->user_id !== null && in_array($this->user->role, [UserRole::Admin, UserRole::SuperAdmin], true);
    }
}
