<?php

namespace App\Http\Controllers\Api\Terminal;

use App\Helpers\ExceptionHandlerHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Terminal\Order\Create as OrderCreate;
use App\Http\Requests\Api\Terminal\Order\Index as OrderGet;
use App\Repositories\Api\Terminal\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(OrderGet $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $orders = $this->orderRepository->getAllOrders($request->validated());
            return $this->sendResponse($orders, 'All TradeOrders');
        });
    }

    public function store(OrderCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $orders = $this->orderRepository->createOrder($request->validated());
            return $this->sendResponse($orders, 'TradeOrder created successfully');
        });
    }

    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $order = $this->orderRepository->findOrderById($id);
            return $this->sendResponse($order, 'Single TradeOrder');
        });
    }

    public function update(OrderCreate $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $order = $this->orderRepository->updateOrder($request->validated(), $id);
            return $this->sendResponse($order, 'TradeOrder updated successfully');
        });
    }

    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->orderRepository->deleteOrder($id);
            return $this->sendResponse([], 'TradeOrder deleted successfully');
        });
    }
}
