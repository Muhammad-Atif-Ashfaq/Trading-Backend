<?php

use App\Models\TransactionOrder;
use App\Models\TradeOrder;

return [
    'transaction_group_order' => [
        'model' => TransactionOrder::class,
        'column' => 'group_unique_id',
    ],
    'trade_group_order' => [
        'model' => TradeOrder::class,
        'column' => 'group_unique_id',
    ],
    // Add more mappings as needed
];