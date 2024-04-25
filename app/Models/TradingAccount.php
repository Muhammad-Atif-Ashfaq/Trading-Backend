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
        'enable_password_change',
        'enable_investor_trading',
        'change_password_at_next_login',
        'enable',
    ];

    protected $with = ['brand'];

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','public_key');
    }

    public function tradingGroup()
    {
        return $this->hasOne(TradingGroup::class, 'trading_group_id' , 'id');
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
