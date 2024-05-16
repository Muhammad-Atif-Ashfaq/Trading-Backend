<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'module',
        'enabled',
        'feed_server',
        'feed_login',
        'feed_password',
    ];
}
