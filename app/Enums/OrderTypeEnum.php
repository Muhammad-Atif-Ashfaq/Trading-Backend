<?php

namespace App\Enums;

final class OrderTypeEnum
{
    const MARKET = 'market';
    const PENDING = 'pending';
    const CLOSE = 'close';

    // TODO: Define a method to retrieve all available order types.
    // TODO: This method returns an array containing all available order types: MARKET, PENDING, and CLOSE.
    public static function getOrderTypes()
    {
        return [
            self::MARKET,
            self::PENDING,
            self::CLOSE,
        ];
    }
}
