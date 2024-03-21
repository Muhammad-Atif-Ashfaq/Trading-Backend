<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SymbelSetting extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'symbel_group_id', 'speed_min', 'speed_max', 'lot_size', 'lot_step', 'commission', 'swap_long', 'swap_short', 'enabled', 'viable'];

    public function group()
    {
        return $this->belongsTo(SymbelGroup::class, 'symbel_group_id');
    }

    public function tradingGroupSymbol()
    {
        return $this->hasMany(TradingGroupSymbol::class);
    }

    public function oneMinuteChart()
    {
        return $this->hasMany(OneMinuteChart::class);
    }

    public function tradingGroups()
    {
        return $this->belongsToMany(TradingGroup::class, 'trading_group_symbols', 'symbel_setting_id', 'trading_group_id');
    }
}
