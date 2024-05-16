<?php

namespace App\Models;

use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tick extends Model
{
    use HasFactory,
        HasSearch;
    protected $fillable = [ 'bid', 'ask', 'last', 'volume'];


}
