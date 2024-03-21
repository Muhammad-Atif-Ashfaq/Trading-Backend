<?php

namespace App\Enums;

final class TransactionOrderTypeEnum
{
    const DEPOSIT = 'deposit';
    const WITHDRAW = 'withdraw';

    public static function getTypes()
    {
        return [
            self::DEPOSIT,
            self::WITHDRAW,
        ];
    }
}
