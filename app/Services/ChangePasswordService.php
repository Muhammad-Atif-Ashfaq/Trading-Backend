<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Str;
use App\Models\TradingAccount;

class ChangePasswordService extends Service
{
    public static function changePassword($request)
    {
        $tradingAccount = TradingAccount::where('login_id', $request['login_id'])->first();
        $update = $tradingAccount->update([
            'password' => $request['new_password']
        ]);
        return $tradingAccount;
    }
}