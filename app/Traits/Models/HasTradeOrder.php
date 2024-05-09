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
            'group_unique_id' => $data['group_unique_id'] ?? null,
            'type'       => $data['type'],
            'volume'     => $data['volume'],
            'stopLoss'   => $data['stopLoss'] ?? null,
            'takeProfit' => $data['takeProfit'] ?? null,
            'open_time'  => $data['open_time'],
            'open_price' => $data['open_price'],
            'close_time' => $data['close_time'] ?? null,
            'close_price'=> $data['close_price'] ?? null,
            'reason'     => $data['reason'] ?? null,
            'swap'       => $data['swap'] ?? null,
            'profit'     => $data['profit'] ?? null,
            'comment'    => $data['comment']  ?? null,
            'stop_limit_price' => $data['stop_limit_price'] ?? null
        ]);
        return $tradeOrder;
    }
    // TODO:Update an existing trade order.
    public function updateTradeOrder(array $data, $id)
    {
        $tradeOrder = static::findOrFail($id);
        $tradeOrder->update([

            'order_type' => $data['order_type'] ?? $tradeOrder->order_type,
            'symbol'     => $data['symbol'] ?? $tradeOrder->order_type,
            'feed_name'     => $data['feed_name'] ?? $tradeOrder->feed_name,
            'trading_account_id' => $data['trading_account_id'] ?? $tradeOrder->trading_account_id,
            'brand_id' => $data['brand_id'] ?? $tradeOrder->brand_id,
            'trading_group_id' => $data['trading_group_id'] ?? $tradeOrder->trading_group_id,
            'group_unique_id' => $data['group_unique_id'] ?? $tradeOrder->group_unique_id,
            'type'       => $data['type'] ?? $tradeOrder->type,
            'volume'     => $data['volume'] ?? $tradeOrder->volume,
            'stopLoss'   => $data['stopLoss'] ?? $tradeOrder->stopLoss,
            'takeProfit' => $data['takeProfit'] ?? $tradeOrder->takeProfit,
            'open_time'  => $data['open_time'] ?? $tradeOrder->open_time,
            'open_price' => $data['open_price'] ?? $tradeOrder->open_price,
            'close_time' => $data['close_time'] ?? $tradeOrder->close_time,
            'close_price'=> $data['close_price'] ?? $tradeOrder->close_price,
            'reason'     => $data['reason'] ?? $tradeOrder->reason,
            'swap'       => $data['swap'] ?? $tradeOrder->swap,
            'profit'     => $data['profit'] ?? $tradeOrder->profit,
            'comment'    => $data['comment'] ?? $tradeOrder->comment,
            'stop_limit_price' => $data['stop_limit_price'] ?? $tradeOrder->stop_limit_price
        ]);

        // Update trading account balance based on transaction type
        $trading_account = TradingAccount::find($data['trading_account_id']);
        if ($data['order_type'] == OrderTypeEnum::CLOSE) {
            $trading_account->balance = (string)( (double)$trading_account->balance + (double)$data['profit']);
        }
        $trading_account->save();

        return $tradeOrder;
    }

}
