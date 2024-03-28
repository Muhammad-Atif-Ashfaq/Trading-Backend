<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'currency',
        'trading_account_id',
        'trading_group_id',
        'trading_group_transaction_order_id',
        'name',
        'group',
        'country',
        'phone',
        'email',
        'type',
        'method',
        'status',
        'comment',
    ];

    public function brand()
    {
        return $this->belongsTo(User::class);
    }
}
