<?php

namespace App\Traits\Models;


trait HasTransactionOrder
{

    // TODO: Create a new transaction order.
    public function createTransactionOrder(array $data){
        $transactionOrder = $this->model->create([
            'amount' => $data['amount'],
            'currency' => $data['currency'],
            'trading_account_id' => $data['trading_account_id'],
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
        return $transactionOrder;
    }

    // TODO: Update an existing transaction order.
    public function updateTransactionOrder(array $data, $id)
    {
        $transactionOrder = $this->model->findOrFail($id);
        $transactionOrder->update([
            'amount' => $data['amount'] ?? $transactionOrder->amount,
            'currency' => $data['currency'] ?? $transactionOrder->currency,
            'trading_account_id' => $data['trading_account_id'] ?? $transactionOrder->trading_account_id,
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
