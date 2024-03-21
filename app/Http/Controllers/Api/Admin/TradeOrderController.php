<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\TradeOrderRepository;
use App\Http\Requests\Api\Admin\TradeOrders\Create as TradeOrderCreate;
use Illuminate\Http\Request;


class TradeOrderController extends Controller
{
    protected $tradeOrderRepository;

    public function __construct(TradeOrderRepository $tradeOrderRepository)
    {
        $this->tradeOrderRepository = $tradeOrderRepository;
    }

    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tradeOrders = $this->tradeOrderRepository->getAllTradeOrders($request);
            return $this->sendResponse($tradeOrders, 'All TradeOrders');
        });
    }

    public function store(TradeOrderCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->tradeOrderRepository->createTradeOrder($request->validated());
            return $this->sendResponse($user, 'TradeOrder created successfully');
        });
    }

    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $tradeOrder = $this->tradeOrderRepository->findTradeOrderById($id);
            return $this->sendResponse($tradeOrder, 'Single TradeOrder');
        });
    }

    public function update(TradeOrderCreate $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $tradeOrder = $this->tradeOrderRepository->updateTradeOrder($request->validated(), $id);
            return $this->sendResponse($tradeOrder, 'TradeOrder updated successfully');
        });
    }

    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->tradeOrderRepository->deleteTradeOrder($id);
            return $this->sendResponse([], 'TradeOrder deleted successfully');
        });
    }
}

