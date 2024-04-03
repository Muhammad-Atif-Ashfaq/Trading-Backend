<?php

namespace App\Enums;

final class TradeOrderTypeEnum
{
    const BUY = 'buy';
    const SELL = 'sell';

    // TODO: Define a method to retrieve all available trade order types.
    // TODO: This method returns an array containing all available trade order types: BUY and SELL.
    public static function getTypes()
    {
        return [
            self::BUY,
            self::SELL,
        ];
    }
}
