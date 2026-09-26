<?php

namespace App\Models;

use App\Enums\SupportTicketStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasUuids;
    protected $fillable = [
        'email',
        'user_id',
        'subject',
        'body',
        'status',
        'attachments_urls',
    ];

    protected $casts = [
        'status' => SupportTicketStatus::class,
        'attachments_urls' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
