<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\TradingAccountRepository;
use App\Http\Requests\Api\Admin\TradingAccounts\Create as TradingAccountCreate;
use Illuminate\Http\Request;


class TradingAccountController extends Controller
{
    protected $tradingAccountRepository;

    public function __construct(TradingAccountRepository $tradingAccountRepository)
    {
        $this->tradingAccountRepository = $tradingAccountRepository;
    }

    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tradingAccounts = $this->tradingAccountRepository->getAllTradingAccounts($request);
            return $this->sendResponse($tradingAccounts, 'All TradingAccounts');
        });
    }

    public function store(TradingAccountCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->tradingAccountRepository->createTradingAccount($request->validated());
            return $this->sendResponse($user, 'TradingAccount created successfully');
        });
    }

    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $tradingAccount = $this->tradingAccountRepository->findTradingAccountById($id);
            return $this->sendResponse($tradingAccount, 'Single TradingAccount');
        });
    }

    public function update(TradingAccountCreate $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $tradingAccount = $this->tradingAccountRepository->updateTradingAccount($request->validated(), $id);
            return $this->sendResponse($tradingAccount, 'TradingAccount updated successfully');
        });
    }

    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->tradingAccountRepository->deleteTradingAccount($id);
            return $this->sendResponse([], 'TradingAccount deleted successfully');
        });
    }
}

