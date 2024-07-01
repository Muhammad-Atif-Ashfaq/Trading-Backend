<?php

namespace App\Http\Controllers\Api\Brand;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Brand\TradingAccountRepository;
use App\Http\Requests\Api\Brand\TradingAccounts\Create as TradingAccountCreate;
use App\Http\Requests\Api\Brand\TradingAccounts\Index as TradingAccountIndex;
use Illuminate\Http\Request;


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
    public function getAllTradingAccountList(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tradingAccounts = $this->tradingAccountRepository->getAllTradingAccountList($request);
            return $this->sendResponse($tradingAccounts, 'All TradingAccounts list');
        });
    }

    // TODO: Retrieves all trading accounts not in any group.
    public function getAllTradingAccountsNotInGroup(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request){
            $tradingAccounts = $this->tradingAccountRepository->getAllTradingAccountsNotInGroup($request);
            return $this->sendResponse($tradingAccounts, 'All TradingAccounts not in any group');
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
    public function update(Request $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $tradingAccount = $this->tradingAccountRepository->updateTradingAccount($request->all(), $id);
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
}

