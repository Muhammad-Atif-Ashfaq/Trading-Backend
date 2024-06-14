<?php

namespace App\Http\Controllers\Api\TradingAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TradingAccount\TradingAccounts\Index as TradingAccountIndex;
use App\Repositories\Api\TradingAccount\TradingAccountRepository;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHandlerHelper;
use App\Http\Requests\Api\TradingAccount\ChangePassword;
use App\Http\Requests\Api\TradingAccount\TradingAccounts\Create as TradingAccountCreate;
use App\Services\ChangePasswordService;

class ProfileController extends Controller
{

    // TODO: Change the password of the trading account.
    public function changePassword(ChangePassword $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = ChangePasswordService::changePassword($request->validated());
            return $this->sendResponse($user, 'TradingAccount password updated successfully');
        });
    }
}
