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

    protected $with = ['symbelGroups','tradingAccounts'];

    public function tradingAccounts()
    {
        return $this->hasMany(TradingAccount::class, 'trading_group_id');
    }

    public function symbelGroups()
    {
        return $this->belongsToMany(SymbelGroup::class, 'trading_group_symbols');
    }
}
