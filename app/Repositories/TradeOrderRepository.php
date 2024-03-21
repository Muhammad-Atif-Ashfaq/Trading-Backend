<?php
namespace App\Repositories;

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

        $tradeOrder = $this->model->create([
            'order_type' => $data['order_type'],
            'symbol'     => $data['symbol'],
            'trading_account_id' => $data['trading_account_id'],
            'type'       => $data['type'],
            'volume'     => $data['volume'],
            'stopLoss'   => $data['stopLoss'] ?? null,
            'takeProfit' => $data['takeProfit'] ?? null,
            'price'      => $data['price'],
            'open_time'  => $data['open_time'],
            'open_price' => $data['open_price'],
            'close_time' => $data['close_time'] ?? null,
            'close_price'=> $data['close_price'] ?? null,
            'reason'     => $data['reason'] ?? null,
            'swap'       => $data['swap'] ?? null,
            'profit'     => $data['profit'] ?? null,
            'comment'    => $data['comment']  ?? null
        ]);


        return $tradeOrder;
    }

    public function findTradeOrderById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateTradeOrder(array $data, $id)
    {
        $tradeOrder = $this->model->findOrFail($id);
        $tradeOrder->update([
            'order_type' => $data['order_type'] ?? $tradeOrder->order_type,
            'symbol'     => $data['symbol'] ?? $tradeOrder->order_type,
            'trading_account_id' => $data['trading_account_id'] ?? $tradeOrder->trading_account_id,
            'type'       => $data['type'] ?? $tradeOrder->type,
            'volume'     => $data['volume'] ?? $tradeOrder->volume,
            'stopLoss'   => $data['stopLoss'] ?? $tradeOrder->stopLoss,
            'takeProfit' => $data['takeProfit'] ?? $tradeOrder->takeProfit,
            'price'      => $data['price'] ?? $tradeOrder->open_time,
            'open_time'  => $data['open_time'] ?? $tradeOrder->price,
            'open_price' => $data['open_price'] ?? $tradeOrder->open_price,
            'close_time' => $data['close_time'] ?? $tradeOrder->close_time,
            'close_price'=> $data['close_price'] ?? $tradeOrder->close_price,
            'reason'     => $data['reason'] ?? $tradeOrder->reason,
            'swap'       => $data['swap'] ?? $tradeOrder->swap,
            'profit'     => $data['profit'] ?? $tradeOrder->profit,
            'comment'    => $data['comment'] ?? $tradeOrder->comment
        ]);
        return $tradeOrder;
    }

    public function deleteTradeOrder($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
