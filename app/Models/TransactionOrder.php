<?php

namespace App\Models;

use App\Traits\Models\HasGroupUniqueId;
use App\Traits\Models\HasTransactionOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionOrder extends Model
{
    use HasFactory,
        HasTransactionOrder,
        HasGroupUniqueId;

    public static $PREFIX = '0xXX'.'new_transaction_order';

    protected $fillable = [
        'amount',
        'currency',
        'trading_account_id',
        'trading_group_id',
        'group_unique_id',
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
