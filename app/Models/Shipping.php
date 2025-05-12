<?php

namespace App\Models;

use App\Services\CountryService;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'country', 'city', 'street', 'price', 'created_at', 'updated_at'
    ];


    // Add this accessor to automatically convert country codes
    public function getCountryCode()
    {
        return CountryService::$countryMappings[strtolower($this->country)] ?? $this->country;
    }
}
