<?php

namespace App\Enums;

final class TransactionOrderTypeEnum
{
    const DEPOSIT = 'deposit';
    const WITHDRAW = 'withdraw';

    // TODO: Define a method to retrieve all available transaction order types.
    // TODO: This method returns an array containing all available transaction order types: DEPOSIT and WITHDRAW.
    public static function getTypes()
    {
        return [
            self::DEPOSIT,
            self::WITHDRAW,
        ];
    }
}
