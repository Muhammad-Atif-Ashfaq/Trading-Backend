<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function brand()
    {
        return $this->belongsTo(User::class);
    }

    public function tradingAccountGroup()
    {
        return $this->belongsTo(TradingAccountGroup::class);
    }
}
