<?php

namespace App\Models;

use App\Enums\Product\ProductStatus;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'short_description',
        'user_id',
        'status',
    ];

    protected $casts = [
        'status' => ProductStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->hasMany(ProductMedia::class);
    }

    public function thumbnail()
    {
        return $this->hasOne(ProductMedia::class)->where('is_thumbnail', true);
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }
}
