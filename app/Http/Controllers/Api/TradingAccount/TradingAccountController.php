<?php

namespace App\Http\Controllers\Api\TradingAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TradingAccount\TradingAccounts\Index as TradingAccountIndex;
use App\Repositories\Api\TradingAccount\TradingAccountRepository;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHandlerHelper;
use App\Http\Requests\Api\TradingAccount\ChangePassword;
use App\Http\Requests\Api\TradingAccount\TradingAccounts\Create as TradingAccountCreate;
use App\Http\Requests\Api\TradingAccount\TradingAccounts\Update as TradingAccountUpdate;
use App\Http\Requests\Api\TradingAccount\TradingAccounts\GetAll as TradingAccountGetAll;
use App\Services\ChangePasswordService;

class TradingAccountController extends Controller
{
    protected $tradingAccountRepository;

    public function __construct(TradingAccountRepository $tradingAccountRepository)
    {
        $this->tradingAccountRepository = $tradingAccountRepository;
    }

    // TODO: Retrieves all trading accounts.
    public function index(TradingAccountIndex $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tradingAccounts = $this->tradingAccountRepository->getAllTradingAccounts($request);
            return $this->sendResponse($tradingAccounts, 'All TradingAccounts');
        });
    }

    // TODO: Retrieves all trading accounts list.
    public function getAllTradingAccountList(TradingAccountGetAll $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tradingAccounts = $this->tradingAccountRepository->getAllTradingAccountList($request);
            return $this->sendResponse($tradingAccounts, 'All TradingAccounts list');
        });
    }


    // TODO: Stores a new trading account.
    public function store(TradingAccountCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->tradingAccountRepository->createTradingAccount($request->validated());
            return $this->sendResponse($user, 'TradingAccount created successfully');
        });
    }

    // TODO: Retrieves a single trading account by ID.
    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $tradingAccount = $this->tradingAccountRepository->findTradingAccountById($id);
            return $this->sendResponse($tradingAccount, 'Single TradingAccount');
        });
    }

    // TODO: Updates a trading account.
    public function update(TradingAccountUpdate $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $tradingAccount = $this->tradingAccountRepository->updateTradingAccount($request->validated(), $id);
            return $this->sendResponse($tradingAccount, 'TradingAccount updated successfully');
        });
    }

    // TODO: Deletes a trading account by ID.
    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->tradingAccountRepository->deleteTradingAccount($id);
            return $this->sendResponse([], 'TradingAccount deleted successfully');
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