<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Str;
use App\Models\TradingAccount;
use App\Models\Brand;

class TerminalLoginService extends Service
{
    public static function attempt(array  $data){
        $trading_account = TradingAccount::where('login_id',$data['login_id'])->where('password',$data['password']);

        if($trading_account->exists()){
            return true;
        }
        return false;
    }
}
