<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\TradingGroupRepository;
use App\Http\Requests\Api\Admin\TradingGroups\Create as TradingGroupCreate;
use Illuminate\Http\Request;


class TradingGroupController extends Controller
{
    protected $tradingGroupRepository;

    public function __construct(TradingGroupRepository $tradingGroupRepository)
    {
        $this->tradingGroupRepository = $tradingGroupRepository;
    }

    // TODO: Retrieves all trading groups.
    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tradingGroups = $this->tradingGroupRepository->getAllTradingGroups($request);
            return $this->sendResponse($tradingGroups, 'All TradingGroups');
        });
    }

    // TODO: Retrieves all trading TradingGroups list.
    public function getAllTradingGroupList(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function ()  use ($request){
            $tradingGroups = $this->tradingGroupRepository->getAllTradingGroupList($request);
            return $this->sendResponse($tradingGroups, 'All TradingGroups list');
        });
    }


    // TODO: Stores a new trading group.
    public function store(TradingGroupCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->tradingGroupRepository->createTradingGroup($request->validated());
            return $this->sendResponse($user, 'TradingGroup created successfully');
        });
    }

    // TODO: Retrieves a single trading group by ID.
    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $tradingGroup = $this->tradingGroupRepository->findTradingGroupById($id);
            return $this->sendResponse($tradingGroup, 'Single TradingGroup');
        });
    }

    // TODO: Updates a trading group.
    public function update(Request $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $tradingGroup = $this->tradingGroupRepository->updateTradingGroup($request->all(), $id);
            return $this->sendResponse($tradingGroup, 'TradingGroup updated successfully');
        });
    }

    // TODO: Deletes a trading group by ID.
    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->tradingGroupRepository->deleteTradingGroup($id);
            return $this->sendResponse([], 'TradingGroup deleted successfully');
        });
    }
}

