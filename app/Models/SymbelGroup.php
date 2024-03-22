<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SymbelGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'leverage', 'lot_size', 'lot_step', 'vol_min', 'vol_max', 'trading_interval'];

    public function settings()
    {
        return $this->hasMany(SymbelSetting::class);
    }
}
