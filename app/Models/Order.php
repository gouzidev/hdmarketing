<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Product;
use App\Models\Shipping;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'shipping_id',
        'count', 'sell-price', 'name', 'email',
        'phone', 'address', 'country', 'city', 'zip'
    ];

    public function product() : hasOne
    {
        return $this->hasOne(Product::class);
    }

    public function shipping() : hasOne
    {
        return $this->hasOne(Shipping::class);
    }
}
