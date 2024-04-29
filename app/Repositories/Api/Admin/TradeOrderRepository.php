<?php

namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\TradeOrderInterface;
use App\Models\TradeOrder;
use App\Models\TradingAccount;

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
        $tradeOrders = $this->model
            ->when(isset($request['brand_id']), function ($query) use ($request) {
                return $query->whereIn('brand_id', $request['brand_id']);
            })->when(isset($request['order_type']), function ($query) use ($request) {
                return $query->whereIn('order_type', $request['order_type']);
            })->when(isset($request['trading_account_id']), function ($query) use ($request) {
                return $query->where('trading_account_id', $request['trading_account_id']);
            });

        $tradeOrders = PaginationHelper::paginate(
            $tradeOrders,
            isset($request['per_page']) ? $request['per_page'] : config('systemSetting.system_per_page_count'),
            isset($request['page']) ? $request['page'] : config('systemSetting.system_current_page')
        );
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

    // TODO: Delete a trade order.
    public function deleteTradeOrder($id)
    {
        $this->model->findOrFail($id)->delete();
    }


}
