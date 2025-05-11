<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Product;
use App\Models\User;
use App\Models\Shipping;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'affiliate_id', 'product_id',
        'status', 'quantity', 'affiliate_price',
        'name', 'email', 'phone',
        'shipping_id', 'address', 'zip',
        'shipping_status', 'payment_date', 'payment_status'
    ];

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function affiliate() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function total()
    {
        return $this->affiliate_price + $this->shipping->price;
    }
    public function shipping() : BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }
}
