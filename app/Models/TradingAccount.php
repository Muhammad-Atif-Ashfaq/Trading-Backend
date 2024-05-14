<?php

namespace App\Models;

use App\Enums\LeverageEnum;
use App\Enums\OrderTypeEnum;
use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class TradingAccount extends Model
{
    use HasFactory,HasApiTokens,
        HasSearch;
    public static $PREFIX = '0xXX'.'AR345WTSQ2567';
    public static $CUSTOMER = '0xXX';
    protected $fillable = [
        'brand_id',
        'brand_customer_id',
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
        'bonus',
        'commission',
        'tax',
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

    protected $with = ['brand','brandCustomer'];

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','public_key');
    }

    public function brandCustomer()
    {
        return $this->belongsTo(User::class,'brand_customer_id','id');
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


    public function getOpenOrdersVolume()
    {
        // Retrieve all open orders for the user
        $openOrders = $this->tradeOrders()->where('order_type', OrderTypeEnum::MARKET)->get(); // Assuming 'orders' is the relationship method

        // Calculate the total volume of open orders
        $totalVolume = 0;
        foreach ($openOrders as $order) {
            $totalVolume += $order->volume;
        }

        return $totalVolume;
    }

    public function getOpenPositionsProfit($symbol_setting)
    {
        // Retrieve all open orders for the user
        $openOrders = $this->tradeOrders()->where('order_type', OrderTypeEnum::MARKET)->get(); // Assuming 'orders' is the relationship method

        // Calculate the total profit/loss of open positions
        $totalProfit = 0;
        foreach ($openOrders as $order) {
            // Assuming you have a method to calculate profit/loss for each order
            $totalProfit += $order->calculateProfitLoss($symbol_setting);
        }

        return $totalProfit;
    }





}
