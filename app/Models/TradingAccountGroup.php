<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingAccountGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function tradingAccounts()
    {
        return $this->hasMany(TradingAccount::class);
    }
}
