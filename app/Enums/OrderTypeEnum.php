<?php

namespace App\Enums;

final class OrderTypeEnum
{
    const MARKET = 'market';
    const PENDING = 'pending';
    const CLOSE = 'close';

    public static function getOrderTypes()
    {
        return [
            self::MARKET,
            self::PENDING,
            self::CLOSE,
        ];
    }
}
