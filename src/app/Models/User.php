<?php

namespace App\Models;

use App\Casts\DateTimeTimezone;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @property string store_id
 * @package App\Models
 */
class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'store_country',
        'personal_country',
        'phone',
        'business_type',
        'monthly_revenue',
        'store_id',
        'status'
    ];

    protected $casts = [
        'created_at' => DateTimeTimezone::class,
        'updated_at' => DateTimeTimezone::class
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return mixed|void
     */
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }

    /**
     * @return string
     */
    function getStoreId(): string
    {
        return $this->store_id;
    }
}
