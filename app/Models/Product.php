<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'name', 'desc', 'stock', 'price', 'category'
    ];
    public function images() : HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primary_image()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function additional_imgs()
    {
        return $this->hasMany(ProductImage::class)->where('is_primary', false)->orderBy('display_order');
    }
}
