<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Models\TransactionOrder;


class TransactionOrderRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new TransactionOrder();

    }

    public function getAllTransactionOrders($request)
    {
        $transactionOrders = $this->model->query();
        $transactionOrders = PaginationHelper::paginate(
            $transactionOrders,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_per_page_count'))
        );
        return $transactionOrders;
    }

    public function createTransactionOrder(array $data)
    {

        $transactionOrder = $this->model->create([
            'amount' => $data['amount'],
            'currency' => $data['currency'],
            'trading_account_id' => $data['trading_account_id'],
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

    public function findTransactionOrderById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateTransactionOrder(array $data, $id)
    {
        $transactionOrder = $this->model->findOrFail($id);
        $transactionOrder->update([
            'amount' => $data['amount'] ?? $transactionOrder->amount,
            'currency' => $data['currency'] ?? $transactionOrder->currency,
            'trading_account_id' => $data['trading_account_id'] ?? $transactionOrder->trading_account_id,
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

    public function deleteTransactionOrder($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
