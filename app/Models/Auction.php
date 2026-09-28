<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'buyout_price',
        'starting_price',
        'current_price',
        'minimum_bid_increment',
        'currency',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function winningBid()
    {
        return $this->belongsTo(Bid::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'auction_category', 'auction_id', 'category_id')->withPivot('is_primary');
    }

    public function primaryCategory()
    {
        return $this->belongsToMany(Category::class, 'auction_category', 'auction_id', 'category_id')->wherePivot('is_primary', true);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
