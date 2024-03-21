<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mass_trading_orders',
        'mass_transaction_orders',
        'mass_leverage',
        'mass_swap',
    ];

    public function tradingAccounts()
    {
        return $this->belongsToMany(TradingAccount::class, 'trading_account_groups');
    }
    public function symbelSettings()
    {
        return $this->belongsToMany(SymbelSetting::class, 'trading_group_symbols', 'trading_group_id', 'symbel_setting_id');
    }
}
