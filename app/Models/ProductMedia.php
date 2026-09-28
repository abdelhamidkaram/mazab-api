<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    
  protected $fillable = [
    'product_id',
    'path',
    'type',
    'mime_type',
    'sort_order',
    'is_thumbnail',
    'name',
    'size',
  ];

  public function product()
  {
    return $this->belongsTo(Product::class);
  }
}
