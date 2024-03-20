<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_type',
        'symbol',
        'trading_account_id',
        'type',
        'volume',
        'stopLoss',
        'takeProfit',
        'price',
        'open_time',
        'open_price',
        'close_time',
        'close_price',
        'reason',
        'swap',
        'profit',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'brand_id', 'id');
    }

    public function tradingAccount()
    {
        return $this->belongsTo(TradingAccount::class);
    }
}
