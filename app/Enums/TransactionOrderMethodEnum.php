<?php

namespace App\Enums;

final class TransactionOrderMethodEnum
{
    const BALANCE = 'balance';
    const COMMISSION = 'commission';
    const TAX = 'tax';
    const CREDIT = 'Credit';
    const BONUS = 'bonus';

    // TODO: Define a method to retrieve all available transaction order methods.
    // TODO: This method returns an array containing all available transaction order methods: BALANCE, COMMISSION_TAX, CREDIT, and BONUS.
    public static function getMethods()
    {
        return [
            self::BALANCE,
            self::COMMISSION,
            self::TAX,
            self::CREDIT,
            self::BONUS,
        ];
    }
}
