<?php

namespace App\Enums;

final class TransactionOrderStatusEnum
{
    const REQUESTED = 'requested';
    const PENDING = 'pending';
    const COMPLETE = 'complete';


    // TODO: Define a method to retrieve all available transaction order statuses.
    // TODO: This method returns an array containing all available transaction order statuses: REQUESTED, PENDING, and COMPLETE.
    public static function getStatuses()
    {
        return [
            self::REQUESTED,
            self::PENDING,
            self::COMPLETE,
        ];
    }
}
