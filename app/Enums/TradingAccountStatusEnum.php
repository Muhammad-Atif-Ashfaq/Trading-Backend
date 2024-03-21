<?php

namespace App\Enums;

final class TradingAccountStatusEnum
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const MARGIN_CALL = 'margin_call';

    public static function getStatuses()
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::MARGIN_CALL,
        ];
    }
}
