<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingGroupSymbol extends Model
{
    use HasFactory;

    protected $fillable = ['symbol_group_id', 'trading_group_id'];

    public function symbolGroup()
    {
        return $this->belongsTo(SymbelGroup::class, 'symbel_group_id');
    }

    public function tradingGroup()
    {
        return $this->belongsTo(TradingGroup::class, 'trading_group_id');
    }
}
