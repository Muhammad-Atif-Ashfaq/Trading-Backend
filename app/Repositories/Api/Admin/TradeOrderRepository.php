<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Models\TradeOrder;


class TradeOrderRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new TradeOrder();

    }

    public function getAllTradeOrders($request)
    {
        $tradeOrders = $this->model->query();
        $tradeOrders = PaginationHelper::paginate(
            $tradeOrders,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_per_page_count'))
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

    public function createGroupTradeOrder($request)
    {
        dd($request);
    }
}
