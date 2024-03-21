<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingGroupSymbol extends Model
{
    use HasFactory;

    protected $fillable = ['symbol_setting_id', 'trading_group_id'];

    public function symbolSetting()
    {
        return $this->belongsTo(SymbelSetting::class, 'symbol_setting_id');
    }

    public function tradingGroup()
    {
        return $this->belongsTo(TradingGroup::class, 'trading_group_id');
    }
}
