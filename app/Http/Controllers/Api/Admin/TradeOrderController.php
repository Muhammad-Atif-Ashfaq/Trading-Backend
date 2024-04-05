<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\TradeOrderInterface;
use App\Http\Requests\Api\Admin\TradeOrders\Create as TradeOrderCreate;
use App\Http\Requests\Api\Admin\TradeGroupOrders\Create as TradeGroupOrders;
use App\Http\Requests\Api\Admin\TradeOrders\Index as TradeOrderIndex;
use Illuminate\Http\Request;


class TradeOrderController extends Controller
{
    protected $tradeOrderRepository;

    public function __construct(TradeOrderInterface $tradeOrderRepository)
    {
        $this->tradeOrderRepository = $tradeOrderRepository;
    }

    // TODO: Retrieves all trade orders.
    public function index(TradeOrderIndex $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tradeOrders = $this->tradeOrderRepository->getAllTradeOrders($request->validated());
            return $this->sendResponse($tradeOrders, 'All TradeOrders');
        });
    }

    // TODO: Stores a new trade order.
    public function store(TradeOrderCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->tradeOrderRepository->createTradeOrder($request->validated());
            return $this->sendResponse($user, 'TradeOrder created successfully');
        });
    }

    // TODO: Retrieves a single trade order by ID.
    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $tradeOrder = $this->tradeOrderRepository->findTradeOrderById($id);
            return $this->sendResponse($tradeOrder, 'Single TradeOrder');
        });
    }

    // TODO: Updates a trade order.
    public function update(Request $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $tradeOrder = $this->tradeOrderRepository->updateTradeOrder($request, $id);
            return $this->sendResponse($tradeOrder, 'TradeOrder updated successfully');
        });
    }

    // TODO: Deletes a trade order by ID.
    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->tradeOrderRepository->deleteTradeOrder($id);
            return $this->sendResponse([], 'TradeOrder deleted successfully');
        });
    }

    
}

