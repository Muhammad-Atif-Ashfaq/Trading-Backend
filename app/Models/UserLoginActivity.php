<?php

namespace App\Models;

use App\Traits\Models\HasActivity;
use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoginActivity extends Model
{
    use HasFactory,
        HasSearch,
        HasActivity;

    protected $fillable = [
        'user_id',
        'ip_address',
        'mac_address',
        'login_time',
        'logout_time',
    ];

    protected $with = ['user'];

    protected $appends = ['user_name'];

    // Accessor for user_name
    public function getUserNameAttribute()
    {
        return isset($this->user)  ? $this->user->name : '';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
