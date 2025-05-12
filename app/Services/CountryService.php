<?php

namespace App\Services;

class CountryService
{
    /**
     * Array mapping country codes to Arabic country names
     *
     * @var array
     */
    public static $countryMappings = [
        'ly' => 'ليبيا',
        'tn' => 'تونس',
        'dz' => 'الجزائر',
        'mr' => 'موريتانيا',
        'eg' => 'مصر',
        'ma' => 'المغرب',
        'jo' => 'الأردن',
        'kw' => 'الكويت',
        'bh' => 'البحرين',
        'qa' => 'قطر',
        'om' => 'عمان',
        'lb' => 'لبنان',
        'sd' => 'السودان',
        'iq' => 'العراق',
        'ye' => 'اليمن',
        'sy' => 'سوريا',
        'ps' => 'فلسطين',
        'so' => 'الصومال',
        'dj' => 'جيبوتي',
        'km' => 'جزر القمر',
        'sa' => 'المملكة العربية السعودية',
        'ae' => 'الإمارات العربية المتحدة'
    ];

    /**
     * Get country name from country code
     *
     * @param string $code Two-letter country code
     * @return string Country name in Arabic
     */
    public static function getCountryName($code)
    {
        
        return $countryMappings[strtolower($code)] ?? $code;
    }

    /**
     * Get all countries as a code => name array
     *
     */
    public static function getAllCountries()
    {
        return CountryService::$countryMappings;
    }
    
    /**
     * Get country select array for form dropdowns
     *
     * @return array
     */
    public static function getCountriesForSelect()
    {
        return CountryService::$countryMappings;
    }
}