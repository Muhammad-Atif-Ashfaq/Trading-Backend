<?php

namespace App\Enums;

final class TransactionOrderMethodEnum
{
    const BALANCE = 'balance';
    const COMMISSION_TAX = 'commissiontax';
    const CREDIT = 'Credit';
    const BONUS = 'bonus';

    public static function getMethods()
    {
        return [
            self::BALANCE,
            self::COMMISSION_TAX,
            self::CREDIT,
            self::BONUS,
        ];
    }
}
