<?php

namespace App\Http\Controllers\Api\Brand;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Brand\GroupTradeOrderRepository;
use App\Http\Requests\Api\Brand\GroupTradeOrders\Create as GroupTradeOrderCreate;
use Illuminate\Http\Request;
use App\Models\TradeOrder;

class GroupTradeOrderController extends Controller
{
    protected $groupTradeOrderRepository;

    public function __construct(GroupTradeOrderRepository $groupTradeOrderRepository)
    {
        $this->groupTradeOrderRepository = $groupTradeOrderRepository;
    }

    // TODO: Retrieves all group trade orders.
    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $groupTradeOrders = $this->groupTradeOrderRepository->getAllGroupTradeOrders($request);
            return $this->sendResponse($groupTradeOrders, 'All GroupTradeOrders');
        });
    }

    // TODO: Stores a new group trade order.
    public function store(GroupTradeOrderCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->groupTradeOrderRepository->createGroupTradeOrder($request->validated());
            return $this->sendResponse($user, 'GroupTradeOrder created successfully');
        });
    }

    // TODO: Retrieves a single group trade order by ID.
    public function show(TradeOrder $tradeOrder)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($tradeOrder) {
            $groupTradeOrder = $this->groupTradeOrderRepository->findGroupTradeOrderById($tradeOrder);
            return $this->sendResponse($groupTradeOrder, 'Single GroupTradeOrder');
        });
    }

    // TODO: Updates a group trade order.
    public function update(Request $request, TradeOrder $tradeOrder)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($tradeOrder, $request) {
            $groupTradeOrder = $this->groupTradeOrderRepository->updateGroupTradeOrder($request->all(), $tradeOrder);
            return $this->sendResponse($groupTradeOrder, 'GroupTradeOrder updated successfully');
        });
    }

    // TODO: Deletes a group trade order by ID.
    public function destroy(TradeOrder $tradeOrder)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($tradeOrder) {
            $this->groupTradeOrderRepository->deleteGroupTradeOrder($tradeOrder);
            return $this->sendResponse([], 'GroupTradeOrder deleted successfully');
        });
    }
}