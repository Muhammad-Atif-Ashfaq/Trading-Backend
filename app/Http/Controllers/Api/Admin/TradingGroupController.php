<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\TradingGroupRepository;
use App\Http\Requests\Api\Admin\TradingGroups\Create as TradingGroupCreate;
use Illuminate\Http\Request;


class TradingGroupController extends Controller
{
    protected $tradingGroupRepository;

    public function __construct(TradingGroupRepository $tradingGroupRepository)
    {
        $this->tradingGroupRepository = $tradingGroupRepository;
    }

    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tradingGroups = $this->tradingGroupRepository->getAllTradingGroups($request);
            return $this->sendResponse($tradingGroups, 'All TradingGroups');
        });
    }

    public function store(TradingGroupCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->tradingGroupRepository->createTradingGroup($request->validated());
            return $this->sendResponse($user, 'TradingGroup created successfully');
        });
    }

    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $tradingGroup = $this->tradingGroupRepository->findTradingGroupById($id);
            return $this->sendResponse($tradingGroup, 'Single TradingGroup');
        });
    }

    public function update(TradingGroupCreate $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $tradingGroup = $this->tradingGroupRepository->updateTradingGroup($request->validated(), $id);
            return $this->sendResponse($tradingGroup, 'TradingGroup updated successfully');
        });
    }

    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->tradingGroupRepository->deleteTradingGroup($id);
            return $this->sendResponse([], 'TradingGroup deleted successfully');
        });
    }
}

