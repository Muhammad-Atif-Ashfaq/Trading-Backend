<?php
use App\Models\TradeOrder;
use App\Models\TradingAccount;

return [
    'symbel_settings' => [
        [
            'model' => TradeOrder::class,
            'keys' => [
                'feed_fetch_name' => 'symbol'
            ]
        ],
        // Add more child models here if needed
    ],
    'brands' => [
        [
            'model' => TradingAccount::class,
            'keys' => [
                'public_key' => 'brand_id'
            ]
        ],
        // Add more child models here if needed
    ],
    // Add other table configurations here
];
