<?php

namespace App\Http\Controllers\Api\Terminal;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Http\Requests\Api\Terminal\TradingAccountLoginActivity\Create as TradingAccountLoginActivityCreate;
use App\Repositories\Api\Terminal\TradingAccountLoginActivityRepository;
use Illuminate\Http\Request;


class TradingAccountLoginActivityController extends Controller
{
    protected $tradingAccountLoginActivityRepository;

    public function __construct(TradingAccountLoginActivityRepository $tradingAccountLoginActivityRepository)
    {
        $this->tradingAccountLoginActivityRepository = $tradingAccountLoginActivityRepository;
    }

    // TODO: Retrieves all TradingAccountLoginActivitys.
    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tradingAccountLoginActivitys = $this->tradingAccountLoginActivityRepository->getAllTradingAccountLoginActivitys($request);
            return $this->sendResponse($tradingAccountLoginActivitys, 'All TradingAccount Login Activities');
        });
    }

    // TODO: Retrieves all trading TradingAccountLoginActivitys list.
    public function getAllTradingAccountLoginActivityList()
    {
        return ExceptionHandlerHelper::tryCatch(function () {
            $tradingAccountLoginActivitys = $this->tradingAccountLoginActivityRepository->getAllTradingAccountLoginActivityList();
            return $this->sendResponse($tradingAccountLoginActivitys, 'All TradingAccount Login Activities list');
        });
    }

    // TODO: Stores a new TradingAccountLoginActivity.
    public function store(TradingAccountLoginActivityCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tradingAccount = $this->tradingAccountLoginActivityRepository->createTradingAccountLoginActivity($request->validated());
            return $this->sendResponse($tradingAccount, 'TradingAccount Login Activity created successfully');
        });
    }

    // TODO: Retrieves a single TradingAccountLoginActivity by ID.
    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $tradingAccountLoginActivity = $this->tradingAccountLoginActivityRepository->findTradingAccountLoginActivityById($id);
            return $this->sendResponse($tradingAccountLoginActivity, 'Single TradingAccount Login Activity');
        });
    }

    // TODO: Updates a TradingAccountLoginActivity.
    public function update(Request $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $tradingAccountLoginActivity = $this->tradingAccountLoginActivityRepository->updateTradingAccountLoginActivity($request->all(), $id);
            return $this->sendResponse($tradingAccountLoginActivity, 'TradingAccount Login Activity updated successfully');
        });
    }

    // TODO: Deletes a TradingAccountLoginActivity by ID.
    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->tradingAccountLoginActivityRepository->deleteTradingAccountLoginActivity($id);
            return $this->sendResponse([], 'TradingAccount Login Activity deleted successfully');
        });
    }
}

