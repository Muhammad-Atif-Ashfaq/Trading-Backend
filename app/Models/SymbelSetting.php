<?php

namespace App\Models;

use App\Enums\LeverageEnum;
use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SymbelSetting extends Model
{
    use HasFactory,
        HasSearch;

    protected $fillable = [
        'name',
        'symbel_group_id',
        'feed_name',
        'feed_fetch_name',
        'feed_fetch_key',
        'speed_max',
        'leverage',
        'swap',
        'lot_size',
        'lot_step',
        'vol_min',
        'vol_max',
        'commission',
        'enabled',
        'pip'
    ];

    protected $with = ['dataFeed'];


    public function dataFeed()
    {
        return $this->belongsTo(DataFeed::class, 'feed_name','module');
    }

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

    protected function leverage(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => LeverageEnum::getAllLeverage()[$value],
        );
    }

}
