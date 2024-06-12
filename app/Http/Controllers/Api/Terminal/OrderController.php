<?php

namespace App\Http\Controllers\Api\Terminal;

use App\Helpers\ExceptionHandlerHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Terminal\Order\MultiTradeOrderUpdate;
use App\Http\Requests\Api\Terminal\Order\Create as OrderCreate;
use App\Repositories\Api\Terminal\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    // TODO: Get all orders for the terminal.
    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $orders = $this->orderRepository->getAllOrders($request);
            return $this->sendResponse($orders, 'All TradeOrders');
        });
    }

    // TODO: Store a new order for the terminal.
    public function store(OrderCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $orders = $this->orderRepository->createOrder($request->validated());
            return $this->sendResponse($orders, 'TradeOrder created successfully');
        });
    }

    // TODO: Get a single order by its ID for the terminal.
    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $order = $this->orderRepository->findOrderById($id);
            return $this->sendResponse($order, 'Single TradeOrder');
        });
    }

    // TODO: Update an existing order for the terminal.
    public function update(OrderCreate $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $order = $this->orderRepository->updateOrder($request->validated(), $id);
            return $this->sendResponse($order, 'TradeOrder updated successfully');
        });
    }
    // TODO: Update multi a trade order.
    public function multiUpdate(MultiTradeOrderUpdate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tradeOrder = $this->tradeOrderRepository->updateMultiTradeOrder($request->orders);
            return $this->sendResponse($tradeOrder, 'TradeOrders updated successfully');
        });
    }

    // TODO: Delete an existing order for the terminal.
    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->orderRepository->deleteOrder($id);
            return $this->sendResponse([], 'TradeOrder deleted successfully');
        });
    }
}
