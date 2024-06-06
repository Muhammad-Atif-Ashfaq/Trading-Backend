<?php

namespace App\Models;

use App\Traits\Models\HasGroupUniqueId;
use App\Traits\Models\HasSearch;
use App\Traits\Models\HasTransactionOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionOrder extends Model
{
    use HasFactory,
        HasTransactionOrder,
        HasGroupUniqueId,
        HasSearch;

    public static $PREFIX = '0xXX'.'new_transaction_order';

    protected $fillable = [
        'amount',
        'currency',
        'trading_account_id',
        'brand_id',
        'trading_group_id',
        'group_unique_id',
        'name',
        'country',
        'phone',
        'email',
        'type',
        'method',
        'status',
        'comment',
    ];

    protected $appends = ['trading_account_loginId', 'trading_group_name'];

    // Accessor for trading_account_loginId
    public function getTradingAccountLoginIdAttribute()
    {
        return isset($this->tradingAccount) ? $this->tradingAccount->login_id : '';
    }

    // Accessor for trading_group_name
    public function getTradingGroupNameAttribute()
    {
        return isset($this->tradingGroup) ? $this->tradingGroup->name : '';
    }

    public function tradingAccount()
    {
        return $this->belongsTo(TradingAccount::class, 'trading_account_id', 'id');
    }

    public function tradingGroup()
    {
        return $this->belongsTo(TradingGroup::class, 'trading_group_id', 'id');
    }
}
