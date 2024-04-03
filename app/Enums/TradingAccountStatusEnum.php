<?php

namespace App\Enums;

final class TradingAccountStatusEnum
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const MARGIN_CALL = 'margin_call';

    // TODO: Define a method to retrieve all available trading account statuses.
    // TODO: This method returns an array containing all available trading account statuses: ACTIVE, INACTIVE, and MARGIN_CALL.
    public static function getStatuses()
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::MARGIN_CALL,
        ];
    }
}
