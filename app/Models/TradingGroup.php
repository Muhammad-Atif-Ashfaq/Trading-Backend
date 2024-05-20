<?php

namespace App\Models;

use App\Enums\LeverageEnum;
use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingGroup extends Model
{
    use HasFactory,
        HasSearch;

    protected $fillable = [
        'name',
        'mass_leverage',
        'mass_swap',
        'brand_id',
    ];

    protected $with = ['symbelGroups','tradingAccounts', 'brands'];

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id','public_key');
    }

    protected $appends = ['brands_name'];

    // Accessor for brands_name
    public function getBrandsNameAttribute()
    {
        return isset($this->brands)  ? $this->brands->name : '';
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id','public_key');
    }

    public function tradingAccounts()
    {
        return $this->hasMany(TradingAccount::class, 'trading_group_id');
    }

    public function symbelGroups()
    {
        return $this->belongsToMany(SymbelGroup::class, 'trading_group_symbols');
    }

    protected function massLeverage(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => LeverageEnum::getAllLeverage()[$value],
        );
    }
}
