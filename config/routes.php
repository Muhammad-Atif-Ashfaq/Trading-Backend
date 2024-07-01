<?php

return [
    'api' => [
        [
            'middleware' => 'api',
            'prefix' => 'api/auth',
            'path' => 'routes/api/auth.php',
        ],
        [
            'middleware' => 'api',
            'prefix' => 'api/admin',
            'path' => 'routes/api/admin.php',
        ],
        [
            'middleware' => 'api',
            'prefix' => 'api/brand',
            'path' => 'routes/api/brand.php',
        ],
        [
            'middleware' => 'api',
            'prefix' => 'api/terminal',
            'path' => 'routes/api/terminal.php',
        ],
        [
            'middleware' => 'api',
            'prefix' => 'api/trading_account',
            'path' => 'routes/api/trading_account.php',
        ],
        [
            'middleware' => 'api',
            'prefix' => 'api/config',
            'path' => 'routes/api/config.php',
        ],
        [
            'middleware' => 'api',
            'prefix' => 'api/setting',
            'path' => 'routes/api/setting.php',
        ],
    ],
    'web' => [
        [
            'middleware' => 'web',
            'path' => 'routes/web.php',
        ],
    ],
];
