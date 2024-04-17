<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SymbelSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbel_group_id',
        'feed_name',
        'feed_server',
        'speed_max',
        'leverage',
        'swap',
        'lot_size',
        'lot_step',
        'vol_min',
        'vol_max',
        'commission',
        'enabled'
    ];

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

    
}
