<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\TradingAccount;

class ChangePasswordService extends Service
{
    // TODO: Change the password of a trading account.
    public static function changePassword($request)
    {
        $tradingAccount = TradingAccount::where('login_id', $request['login_id'])->first();
        $update = $tradingAccount->update([
            'password' => $request['new_password']
        ]);
        return $tradingAccount;
    }
}
