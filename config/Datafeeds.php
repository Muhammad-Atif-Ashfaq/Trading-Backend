<?php
return [
    [
        'name' => 'binance',
        'module' => 'binance',
        'feed_server' => 'https://api.binance.com/api/v3',
        'fields' => []
    ],
    [
        'name' => 'fcsapi',
        'module' => 'fcsapi',
        'feed_server' => 'https://fcsapi.com/api-v3',
        'fields' => [
            [
                'name' => 'feed_login',
                'label' => 'Access Key'
            ]
        ]
    ],
    [
        'name' => 'tradermade',
        'module' => 'tradermade',
        'feed_server' => 'https://marketdata.tradermade.com/api/v1',
        'fields' => [
            [
                'name' => 'feed_login',
                'label' => 'Access Key'
            ]
        ]
    ],
    [
        'name' => 'twelvedata',
        'module' => 'twelvedata',
        'feed_server' => 'https://api.twelvedata.com',
        'fields' => [
            [
                'name' => 'feed_login',
                'label' => 'Api Key'
            ]
        ]
    ], [
        'name' => 'finnhub',
        'module' => 'finnhub',
        'feed_server' => 'https://finnhub.io/api/v1',
        'fields' => [
            [
                'name' => 'feed_login',
                'label' => 'Api Key'
            ]
        ]
    ], [
        'name' => 'finage',
        'module' => 'finage',
        'feed_server' => 'https://api.finage.co.uk',
        'fields' => [
            [
                'name' => 'feed_login',
                'label' => 'Api Key'
            ]
        ]
    ],
];
