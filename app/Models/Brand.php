<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public static $PREFIX = '0xX'.'AR345WTSQ2567';
    public static $BRAND = '0xX';

    protected $fillable=['user_id', 'name','public_key','domain','margin_call'];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
