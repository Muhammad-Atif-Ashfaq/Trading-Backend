<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasFactory;
    protected $table = '1_minute_charts';
    protected $fillable = [ 'name', 'open', 'high', 'low', 'close'];


}
