<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mass_leverage',
        'mass_swap',
    ];

    protected $with = ['symbelGroup'];

    public function tradingAccounts()
    {
        return $this->belongsToMany(TradingAccount::class, 'trading_account_groups');
    }

    public function symbelGroup()
    {
        return $this->belongsToMany(SymbelGroup::class, 'trading_group_symbols');
    }
}
