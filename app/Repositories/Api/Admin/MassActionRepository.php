<?php

namespace App\Repositories\Api\Admin;

use App\Enums\OrderTypeEnum;
use App\Helpers\SystemHelper;
use App\Interfaces\Api\Admin\MassActionInterface;
use App\Models\SymbelSetting;
use App\Models\TradeOrder;
use App\Models\TradingAccount;
use Illuminate\Support\Facades\DB;

class MassActionRepository implements MassActionInterface
{

    public function massEdit(array $data,array $values)
    {
        $tableName = new (tableToModel($data['table_name']))();
        $tableIds = $data['table_ids'] ?? [];

        if (empty($tableIds)) {
            // If table_ids is empty, update all rows from the table
            return $tableName->update($values);
        } else {
            // If table_ids is not empty, update rows with the specified ids
            return $tableName->whereIn($data['column_name'] ?? 'id', $tableIds)->update($values);
        }
    }


    public function massDelete(array $data)
    {
        $tableName =  new (tableToModel($data['table_name']))();
        $tableIds = $data['table_ids'] ?? [];

        if (empty($tableIds)) {
            // If table_ids is empty, delete all rows from the table
            return $tableName->delete();
        } else {
            // If table_ids is not empty, delete rows with the specified ids
            return $tableName->whereIn($data['column_name'] ?? 'id', $tableIds)->delete();
        }
    }

    public function massCloseOrders(array $ids)
    {
        // Fetch all trade orders with the given IDs
        $tradeOrders = TradeOrder::whereIn('id',$ids)->get();

        // Iterate through each trade order and update it
        foreach ($tradeOrders as $tradeOrder) {
            $symbol_setting = SymbelSetting::where('feed_fetch_name',$tradeOrder->symbol)->first();
            $currentPrice = $tradeOrder->getCurrentPrice($symbol_setting);
            $profit = $tradeOrder->calculateProfitLoss($currentPrice,$tradeOrder->open_price);
            $tradeOrder->profit = $profit;
            $tradeOrder->order_type = OrderTypeEnum::CLOSE;
            $tradeOrder->close_price = $currentPrice;
            $tradeOrder->close_time = now();
            $tradeOrder->save();

            // Update trading account balance based on profit
            $trading_account = TradingAccount::find($tradeOrder->trading_account_id);
            $returnBalance = (double)$trading_account->balance + (double)$profit ?? 0;
            $returnBalance -= ((double)$symbol_setting->commission * (double)$tradeOrder->valume);
            $calswap = calculateCalswap((double)$tradeOrder->valume, calculateNights($tradeOrder->created_at, now()), $symbol_setting);
            $newBalance = max($returnBalance - (double)$calswap, 0);
            $trading_account->balance = (string)$newBalance;
            $trading_account->save();

        }
        return $tradeOrders;

    }

}
