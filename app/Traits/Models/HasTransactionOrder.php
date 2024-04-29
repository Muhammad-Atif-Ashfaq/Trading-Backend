<?php

namespace App\Traits\Models;

use App\Enums\TransactionOrderTypeEnum;
use App\Models\TradingAccount;
use App\Models\TransactionOrder;


trait HasTransactionOrder
{
    // TODO: Create a new transaction order.
    public function createTransactionOrder(array $data)
    {
        $transactionOrder = TransactionOrder::create([
            'amount' => $data['amount'],
            'currency' => $data['currency'],
            'trading_account_id' => $data['trading_account_id'],
            'brand_id' => $data['brand_id'],
            'trading_group_id' => $data['trading_group_id'] ?? null,
            'group_unique_id' => $data['group_unique_id'] ?? null,
            'name' => $data['name'],
            'group' => $data['group'],
            'country' => $data['country'] ?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'type' => $data['type'],
            'method' => $data['method'],
            'status' => $data['status'],
            'comment' => $data['comment'] ?? null
        ]);

        // Update trading account balance based on transaction type
        $trading_account = TradingAccount::find($data['trading_account_id']);
        if ($data['type'] == TransactionOrderTypeEnum::DEPOSIT) {
            $trading_account->balance = (string)( (double)$trading_account->balance + (double)$data['amount']);
        } elseif ($data['type'] == TransactionOrderTypeEnum::WITHDRAW) {
            $trading_account->balance = (string)( (double)$trading_account->balance - (double)$data['amount']);
        }
        $trading_account->save();

        return $transactionOrder;
    }

    // TODO: Update an existing transaction order.
    public function updateTransactionOrder(array $data, $id)
    {
        $transactionOrder = TransactionOrder::findOrFail($id);
        $transactionOrder->update([
            'amount' => $data['amount'] ?? $transactionOrder->amount,
            'currency' => $data['currency'] ?? $transactionOrder->currency,
            'trading_account_id' => $data['trading_account_id'] ?? $transactionOrder->trading_account_id,
            'brand_id' => $data['brand_id'] ?? $transactionOrder->brand_id,
            'trading_group_id' => $data['trading_group_id'] ?? $transactionOrder->trading_group_id,
            'group_unique_id' => $data['group_unique_id'] ?? $transactionOrder->group_unique_id,
            'name' => $data['name'] ?? $transactionOrder->name,
            'group' => $data['group'] ?? $transactionOrder->group,
            'country' => $data['country'] ?? $transactionOrder->country,
            'phone' => $data['phone'] ?? $transactionOrder->phone,
            'email' => $data['email'] ?? $transactionOrder->email,
            'type' => $data['type'] ?? $transactionOrder->type,
            'method' => $data['method'] ?? $transactionOrder->method,
            'status' => $data['status'] ?? $transactionOrder->status,
            'comment' => $data['comment'] ?? $transactionOrder->comment
        ]);
        return $transactionOrder;
    }

}
