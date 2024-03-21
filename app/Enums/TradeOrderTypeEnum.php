<?php

namespace App\Enums;

final class TradeOrderTypeEnum
{
    const BUY = 'buy';
    const SELL = 'sell';

    public static function getTypes()
    {
        return [
            self::BUY,
            self::SELL,
        ];
    }
}
