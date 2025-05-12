<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\AdminRequest;
use App\Services\CountryService;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'is_admin',
        'verified',
        'verified_at',
        'country',
        'password',
    ];

    protected $casts = [
        'verified_at' => 'datetime',  // This will automatically cast to Carbon instance
        'verified' => 'boolean',
        'is_admin' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function adminRequests() : HasMany
    {
        return $this->hasMany(AdminRequest::class);
    }

    public function approvedRequests(): HasMany
    {
        return $this->hasMany(AdminRequest::class, 'admin_at');
    }
    protected static function boot()
    {
        parent::boot();
        static::deleting(
            function($user) 
            {
                if ($user->isForceDeleting()) {
                    // Hard delete - handled by database cascade
                    $user->adminRequests()->forceDelete();
                } else {
                    // Soft delete - manually delete related requests
                    $user->adminRequests()->delete();
                }
            }
        );
        // When user is restored
        static::restoring(function($user) {
        });
    }

    public function getCountryCode()
    {
        return CountryService::$countryMappings[strtolower($this->country)] ?? $this->country;
    }
}
