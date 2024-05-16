<?php

namespace App\Models;

use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasFactory,
        HasSearch;
    protected $table = '1_minute_charts';
    protected $fillable = [ 'name','time', 'open', 'high', 'low', 'close','volume'];


}
