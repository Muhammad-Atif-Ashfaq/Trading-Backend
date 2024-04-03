<?php

namespace App\Http\Controllers\Api\TradingAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\TradingAccount\TradingAccountRepository;
use App\Http\Requests\Api\TradingAccount\ChangePassword;
use App\Http\Requests\Api\Admin\TradingAccounts\Create as TradingAccountCreate;
use App\Services\ChangePasswordService;

class TradingAccountController extends Controller
{
    protected $TradingAccountRepository;

    public function __construct(TradingAccountRepository $TradingAccountRepository)
    {
        $this->TradingAccountRepository = $TradingAccountRepository;
    }

    // TODO: Store a newly created trading account.
    public function store(TradingAccountCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->TradingAccountRepository->createTradingAccount($request->validated());
            return $this->sendResponse($user, 'TradingAccount created successfully');
        });
    }

    // TODO: Change the password of the trading account.
    public function changePassword(ChangePassword $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = ChangePasswordService::changePassword($request->validated());
            return $this->sendResponse($user, 'TradingAccount password updated successfully');
        });
    }
}
