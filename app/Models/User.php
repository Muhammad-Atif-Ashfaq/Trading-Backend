<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The prefix for the user.
     *
     * @var string
     */
    public const PREFIX = '0xXAR345WTSQ2567';

    /**
     * The brand for the user.
     *
     * @var string
     */
    public const BRAND = '0xX';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'original_password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['roles', 'permissions'];


    /**
     * Get the trading accounts associated with the user.
     */
    public function tradingAccounts()
    {
        return $this->hasMany(TradingAccount::class);
    }

    /**
     * Get the trade orders associated with the user.
     */
    public function tradeOrders()
    {
        return $this->hasMany(TradeOrder::class);
    }

    /**
     * Get the transactions orders associated with the user.
     */
    public function transactionsOrders()
    {
        return $this->hasMany(TransactionOrder::class);
    }

}
