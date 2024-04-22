<?php

namespace App\Models;

use App\Enums\LeverageEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class TradingAccount extends Model
{
    use HasFactory,HasApiTokens;
    public static $PREFIX = '0xXX'.'AR345WTSQ2567';
    public static $CUSTOMER = '0xXX';
    protected $fillable = [
        'brand_id',
        'trading_group_id',
        'public_key',
        'login_id',
        'password',
        'country',
        'phone',
        'name',
        'email',
        'leverage',
        'balance',
        'credit',
        'equity',
        'margin_level_percentage',
        'profit',
        'swap',
        'currency',
        'registration_time',
        'last_access_time',
        'last_access_address_IP',
        'status',
    ];

    public function brand()
    {
        return $this->belongsTo(User::class);
    }

    public function tradingGroups()
    {
        return $this->belongsToMany(TradingGroup::class, 'trading_account_groups');
    }

    public function tradingGroupSymbol()
    {
        return $this->hasMany(TradingGroupSymbol::class);
    }

    public function tradeOrders()
    {
        return $this->hasMany(TradeOrder::class);
    }

    protected function leverage(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => LeverageEnum::getAllLeverage()[$value],
        );
    }
}
