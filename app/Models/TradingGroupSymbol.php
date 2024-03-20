<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingGroupSymbol extends Model
{
    use HasFactory;

    protected $fillable = ['symbol_setting_id', 'trading_account_id']; 

    public function symbolSetting()
    {
        return $this->belongsTo(SymbelSetting::class, 'symbol_setting_id');
    }

    public function tradingAccount()
    {
        return $this->belongsTo(TradingAccount::class, 'trading_account_id');
    }
}