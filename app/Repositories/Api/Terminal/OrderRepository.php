<?php

namespace App\Repositories\Api\Terminal;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Terminal\OrderInterface;
use App\Models\TradeOrder;


class OrderRepository implements OrderInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new TradeOrder();
    }

    //  TODO: Get all orders.
    public function getAllOrders($request)
    {
        $tradeOrders = $this->model->whereSearch($request);

        $tradeOrders = PaginationHelper::paginate(
            $tradeOrders,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_per_page_count'))
        );
        return $tradeOrders;
    }

    // TODO: Create an order.
    public function createOrder(array $data)
    {
        return $this->model->createTradeOrder($data);
    }

    // TODO: Find an order by ID.
    public function findOrderById($id)
    {
        return $this->model->findOrFail($id);
    }

    // TODO: Update an order.
    public function updateOrder(array $data, $id)
    {
        return $this->model->updateTradeOrder($data, $id);
    }

    // TODO: Update a trade order.
    public function updateMultiTradeOrder(array $data)
    {
        return $this->model->updateMultiTradeOrder($data);
    }

    // TODO: Delete an order.
    public function deleteOrder($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
