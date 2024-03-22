<?php
namespace App\Repositories\Api\Terminal;

use App\Helpers\PaginationHelper;
use App\Models\TradeOrder;
use Illuminate\Database\Eloquent\Model;


class OrderRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new TradeOrder();
    }

    public function getAllOrders($request)
    {
        $tradeOrders = $this->model->when($request->has('order_type'), function ($query) use ($request) {
            return $query->where('order_type', $request->order_type);
        })->get();
        $tradeOrders = PaginationHelper::paginate(
            $tradeOrders,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_per_page_count'))
        );
        return $tradeOrders;
    }

    public function createOrder(array $data)
    {
        return $this->model->createTradeOrder($data);
    }

    public function findOrderById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateOrder(array $data, $id)
    {
        return $this->model->updateTradeOrder($data, $id);
    }

    public function deleteOrder($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
