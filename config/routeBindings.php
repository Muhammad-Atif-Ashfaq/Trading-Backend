<?php

use App\Models\Brand;
use App\Models\TradeOrder;
use App\Models\TransactionOrder;

return [
    'transaction_group_order' => [
        'model' => TransactionOrder::class,
        'column' => 'group_unique_id',
    ],
    'trade_group_order' => [
        'model' => TradeOrder::class,
        'column' => 'group_unique_id',
    ],
    'brand_public_key' => [
        'model' => Brand::class,
        'column' => 'public_key',
    ],
    'brand_domain' => [
        'model' => Brand::class,
        'column' => 'domain',
    ],
    // Add more mappings as needed
];
