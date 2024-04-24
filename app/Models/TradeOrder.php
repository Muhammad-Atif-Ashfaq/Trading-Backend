<?php

namespace App\Models;

use App\Traits\Models\HasGroupUniqueId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\HasTradeOrder;

class TradeOrder extends Model
{
    use HasFactory,
        HasTradeOrder,
        HasGroupUniqueId;

    public static $PREFIX = '0xXX'.'new_order';

    protected $fillable = [
        'order_type',
        'symbol',
        'trading_account_id',
        'trading_group_id',
        'group_unique_id',
        'type',
        'volume',
        'stopLoss',
        'takeProfit',

        'open_time',
        'open_price',
        'close_time',
        'close_price',
        'reason',
        'swap',
        'profit',
        'comment',
        'stop_limit_price'
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
