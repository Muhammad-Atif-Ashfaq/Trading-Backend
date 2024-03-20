<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneMinuteChart extends Model
{
    use HasFactory;

    protected $table = '1_minute_chart';

    protected $fillable = ['name', 'open', 'high', 'low', 'close', 'symbel_setting_id'];

    public function symbolSetting()
    {
        return $this->belongsTo(SymbelSetting::class, 'symbel_setting_id');
    }
}
