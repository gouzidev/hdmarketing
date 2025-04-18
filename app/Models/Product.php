<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'name', 'desc', 'stock', 'price'
    ];
    public function images() : HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
}
