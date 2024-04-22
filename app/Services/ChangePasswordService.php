<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\{TradingAccount, User};
use Hash;

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

    public static function adminChangePassword($request)
    {
        $admin = User::find(auth()->user()->id);
        $update = $admin->update([
            'password' => Hash::make($request['new_password']),
            'original_password' => $request['new_password']
        ]);
        return $admin;
    }
}
