<?php

namespace App\Models;

use App\Enums\LeverageEnum;
use App\Enums\OrderTypeEnum;
use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Request;

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
        'symbols_leverage',
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

    protected $with = ['brand','brandCustomer','group'];

    protected $appends = ['brand_customer_name','brand_name','group_name'];



    // Accessor for brand_customer_name
    public function getBrandCustomerNameAttribute()
    {
        return isset($this->brandCustomer)  ? $this->brandCustomer->name : '';
    }

    // Accessor for brand_name
    public function getBrandNameAttribute()
    {
        return isset($this->brand)  ? $this->brand->name : '';
    }

    // Accessor for group_name
    public function getGroupNameAttribute()
    {
        return isset($this->group)  ? $this->group->name : '';
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','public_key');
    }

    public function brandCustomer()
    {
        return $this->belongsTo(User::class,'brand_customer_id','id');
    }

    public function group()
    {
        return $this->belongsTo(TradingGroup::class, 'trading_group_id', 'id');
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

    protected function symbolsLeverage(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => json_encode($value),
            get: fn (string|null $value) => (!empty($value) && $value != null) ? json_decode($value, true) : []
        );
    }

    // Method to log login activity
    public function logLoginActivity()
    {
        $ip = Request::ip();
        TradingAccountLoginActivity::add($ip,$this->id,'trading_account_id');
    }

    // Relationship method for login activities
    public function loginActivities()
    {
        return $this->hasMany(TradingAccountLoginActivity::class);
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
