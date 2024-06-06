<?php

namespace App\Traits\Models;

use App\Enums\TransactionOrderMethodEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Models\TradingAccount;
use App\Models\TransactionOrder;


trait HasTransactionOrder
{
    // TODO: Create a new transaction order.
    public function createTransactionOrder(array $data)
    {
        $method = $data['method'];
        $transactionOrder = TransactionOrder::create([
            'amount' => $data['amount'],
            'currency' => $data['currency'],
            'trading_account_id' => $data['trading_account_id'],
            'brand_id' => $data['brand_id'],
            'trading_group_id' => $data['trading_group_id'] ?? null,
            'group_unique_id' => $data['group_unique_id'] ?? null,
            'name' => $data['name'],
            'country' => $data['country'] ?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'type' => $data['type'],
            'method' => $method,
            'status' => $data['status'],
            'comment' => $data['comment'] ?? null
        ]);

        // Update trading account balance based on transaction type
        $trading_account = TradingAccount::find($data['trading_account_id']);
        if ($transactionOrder->type == TransactionOrderTypeEnum::DEPOSIT) {
            $trading_account->$method = (string)((double)$trading_account->$method + (double)$transactionOrder->amount);
        } elseif ($transactionOrder->type == TransactionOrderTypeEnum::WITHDRAW) {
            $trading_account->$method = (string)((double)$trading_account->$method - (double)$transactionOrder->amount);
        }
        $trading_account->save();


        return $transactionOrder;
    }

    // TODO: Update an existing transaction order.
    public function updateTransactionOrder(array $data, $id)
    {
        $transactionOrder = TransactionOrder::findOrFail($id);
        $transactionOrder->update(prepareUpdateCols($data, 'transaction_orders'));
        return $transactionOrder;
    }

}
