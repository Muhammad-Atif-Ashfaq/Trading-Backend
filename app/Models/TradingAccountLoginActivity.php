<?php

namespace App\Models;

use App\Traits\Models\HasSearch;
use App\Traits\Models\HasActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingAccountLoginActivity extends Model
{
    use HasFactory,
        HasSearch,
        HasActivity;

    protected $fillable = [
        'trading_account_id',
        'ip_address',
        'mac_address',
        'login_time',
        'logout_time',
    ];

    public function tradingAccount()
    {
        return $this->belongsTo(TradingAccount::class);
    }

}
