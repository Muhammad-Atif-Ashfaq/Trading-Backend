<?php

namespace App\Models;

use App\Traits\Models\HasIp;
use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpList extends Model
{
    use HasFactory,
        HasSearch,
        HasIp;

    protected $table = 'ip_list';
    protected $fillable = [
        'ip_address',
    ];

}
