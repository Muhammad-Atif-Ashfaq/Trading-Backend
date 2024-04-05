<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Models\TradeOrder;
use App\Models\TradingAccount;


class TradeOrderRepository
{
    private $model;
    private $model_1;

    public function __construct()
    {
        $this->model = new TradeOrder();
    }

    public function getAllTradeOrders($request)
    {
        $tradeOrders = $this->model->when($request->has('order_type'), function ($query) use ($request) {
            return $query->where('order_type', $request->order_type);
        });
        $tradeOrders = PaginationHelper::paginate(
            $tradeOrders,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $tradeOrders;
    }

    public function createTradeOrder(array $data)
    {
        return $this->model->createTradeOrder($data);
    }

    public function findTradeOrderById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateTradeOrder(array $data, $id)
    {
        return $this->model->updateTradeOrder($data, $id);
    }

    public function deleteTradeOrder($id)
    {
        $this->model->findOrFail($id)->delete();
    }

    
}
