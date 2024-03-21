<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tick extends Model
{
    use HasFactory;
    protected $fillable = [ 'bid', 'ask', 'last', 'volume'];


}
