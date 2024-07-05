<?php

namespace App\Enums;

final class TradeOrderTypeEnum
{
    const BUY = 'buy';

    const SELL = 'sell';

    const SELL_LIMIT = 'Sell Limit'; // Corrected constant declaration

    const BUY_LIMIT = 'Buy Limit'; // Corrected constant declaration

    const BUY_STOP = 'Buy Stop';

    const SELL_STOP = 'Sell Stop'; // Corrected constant name

    const BUY_SELL_LIMIT = 'Buy Sell Limit';

    const SELL_STOP_LIMIT = 'Sell Stop Limit'; // Corrected missing closing quote

    // Method to retrieve all available trade order types
    public static function getTypes()
    {
        return [
            self::BUY,
            self::SELL,
            self::SELL_LIMIT,
            self::BUY_LIMIT,
            self::BUY_STOP,
            self::SELL_STOP,
            self::BUY_SELL_LIMIT,
            self::SELL_STOP_LIMIT,
        ];
    }
}
