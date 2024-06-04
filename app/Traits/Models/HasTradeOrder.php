<?php

namespace App\Traits\Models;


use App\Enums\OrderTypeEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Models\TradingAccount;

trait HasTradeOrder
{
    // TODO:Create a new trade order.
    public function createTradeOrder(array $data){
        $tradeOrder = static::create([
            'order_type' => $data['order_type'],
            'symbol'     => $data['symbol'],
            'feed_name'     => $data['feed_name'],
            'trading_account_id' => $data['trading_account_id'],
            'brand_id' => $data['brand_id'],
            'trading_group_id' => $data['trading_group_id'] ?? null,
            'group_unique_id' => $data['group_unique_id'] ?? '',
            'type'       => $data['type'],
            'volume'     => $data['volume'],
            'stopLoss'   => $data['stopLoss'] ?? '',
            'takeProfit' => $data['takeProfit'] ?? '',
            'open_time'  => $data['open_time'],
            'open_price' => $data['open_price'],
            'close_time' => $data['close_time'] ?? '',
            'close_price'=> $data['close_price'] ?? '',
            'reason'     => $data['reason'] ?? '',
            'swap'       => $data['swap'] ?? '',
            'commission'       => $data['commission'] ?? '',
            'profit'     => $data['profit'] ?? '',
            'comment'    => $data['comment']  ?? '',
            'stop_limit_price' => $data['stop_limit_price'] ?? ''
        ]);
        return $tradeOrder;
    }

    // TODO:Update an existing trade order.
    public function updateTradeOrder(array $data, $id)
    {
        $tradeOrder = static::findOrFail($id);
        $tradeOrder->update(prepareUpdateCols($data, 'trade_orders'));

        // Update trading account balance based on transaction type

        if ($data['order_type'] == OrderTypeEnum::CLOSE) {
            $trading_account = TradingAccount::find($data['trading_account_id']);
            $returnBalance = (double) $trading_account->balance + (double)$data['profit'];
            $trading_account->balance = (string) ($returnBalance - (double)$data['swap']);
            $trading_account->save();
        }


        return $tradeOrder;
    }

    // TODO:Update multi an existing trade order.
    public function updateMultiTradeOrder(array $orders)
    {
        foreach ($orders as $order){
            $tradeOrder = static::findOrFail($order['id']);
            unset($order['id']);
            unset($order['created_at']);
            unset($order['updated_at']);
            unset($order['data_feed']);

            // Update trading account balance based on transaction type

            if (isset($order['order_type']) && $order['order_type'] == OrderTypeEnum::CLOSE) {
                $trading_account = TradingAccount::find($order['trading_account_id']);
                $returnBalance = (double) $trading_account->balance + (double)$order['profit'];
                $trading_account->balance = (string) ($returnBalance - (double)$order['swap']);
                $trading_account->save();
            }


            $tradeOrder->update(prepareUpdateCols($order, 'trade_orders'));
        }
        return $orders;
    }

}
