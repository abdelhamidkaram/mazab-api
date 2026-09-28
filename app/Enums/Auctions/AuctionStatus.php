<?php

namespace App\Enums\Auctions;

enum AuctionStatus: string
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case PENDING = 'pending';
    case SCHEDULED = 'scheduled';
    case CLOSED = 'closed';
}
