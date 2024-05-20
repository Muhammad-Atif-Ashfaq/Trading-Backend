<?php

namespace App\Models;

use App\Enums\LeverageEnum;
use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SymbelGroup extends Model
{
    use HasFactory,
        HasSearch;

    protected $fillable = [
        'name',
        'leverage',
        'lot_size',
        'lot_step',
        'vol_min',
        'vol_max',
        'trading_interval',
        'swap'
    ];

    public function settings()
    {
        return $this->hasMany(SymbelSetting::class);
    }

    public function tradingGroups()
    {
        return $this->belongsToMany(TradingGroup::class, 'trading_group_symbols');
    }

    protected function leverage(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => LeverageEnum::getAllLeverage()[$value],
        );
    }
}
