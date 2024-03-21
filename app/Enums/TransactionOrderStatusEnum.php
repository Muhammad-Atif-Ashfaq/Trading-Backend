<?php

namespace App\Enums;

final class TransactionOrderStatusEnum
{
    const REQUESTED = 'requested';
    const PENDING = 'pending';
    const COMPLETE = 'complete';

    public static function getStatuses()
    {
        return [
            self::REQUESTED,
            self::PENDING,
            self::COMPLETE,
        ];
    }
}
