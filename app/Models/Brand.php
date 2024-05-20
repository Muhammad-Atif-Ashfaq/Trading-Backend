<?php

namespace App\Models;

use App\Enums\LeverageEnum;
use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory,
        HasSearch;
    public static $PREFIX = '0xX'.'AR345WTSQ2567';
    public static $BRAND = '0xX';

    protected $fillable=['user_id', 'name','public_key','domain','margin_call','leverage',  'stop_out',];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function leverage(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => LeverageEnum::getAllLeverage()[$value],
        );
    }
}
