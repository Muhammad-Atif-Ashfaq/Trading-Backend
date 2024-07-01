<?php

namespace App\Repositories\Api\Brand;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Brand\TradeOrderInterface;
use App\Models\TradeOrder;

class TradeOrderRepository implements TradeOrderInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new TradeOrder();
    }

    // TODO: Get all trade orders.
    public function getAllTradeOrders($request)
    {

        $tradeOrders = $this->model->whereSearch($request);

        $tradeOrders = PaginationHelper::paginate(
            $tradeOrders,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        $tradeOrders->getCollection()->transform(function ($tradeOrder) {
            return $tradeOrder->makeHidden(['symbolSetting', 'tradingAccount']);
        });

        return $tradeOrders;
    }

    //  TODO: Create a trade order.
    public function createTradeOrder(array $data)
    {
        return $this->model->createTradeOrder($data);
    }

    // TODO: Find a trade order by ID.
    public function findTradeOrderById($id)
    {
        return $this->model->findOrFail($id);
    }

    // TODO: Update a trade order.
    public function updateTradeOrder(array $data, $id)
    {
        return $this->model->updateTradeOrder($data, $id);
    }

    // TODO: Update a trade order.
    public function updateMultiTradeOrder(array $data)
    {
        return $this->model->updateMultiTradeOrder($data);
    }

    // TODO: Delete a trade order.
    public function deleteTradeOrder($id)
    {
        $this->model->findOrFail($id)->delete();
    }


}