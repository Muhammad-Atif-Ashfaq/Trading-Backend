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
        'brand_id',
        'status',
    ];

    protected $appends = ['brand_name'];


    // Accessor for brand_name
    public function getBrandNameAttribute()
    {
        return isset($this->brand) ? $this->brand->name : '';
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','public_key');
    }

}
