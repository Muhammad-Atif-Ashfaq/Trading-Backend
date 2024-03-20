<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
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
}
