<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingAccountGroup extends Model
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
        return $this->hasMany(TradingAccount::class);
    }
}
