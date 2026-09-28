<?php

namespace App\Enums\Product;

enum ProductStatus:string
{
    case Draft = 'draft';
    case Pending = 'pending';
    case Active = 'active';
    case InActive = 'inactive';
}
