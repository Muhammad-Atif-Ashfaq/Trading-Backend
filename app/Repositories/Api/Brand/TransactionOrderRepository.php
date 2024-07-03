<?php

namespace App\Repositories\Api\Brand;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Brand\TransactionOrderInterface;
use App\Models\TransactionOrder;
use App\Helpers\CheckPermissionsHelper;

class TransactionOrderRepository implements TransactionOrderInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new TransactionOrder();
    }

    // TODO: Get all transaction orders.
    public function getAllTransactionOrders($request)
    {
        CheckPermissionsHelper::checkBrandPermission($request['brand_id'], 'transaction_orders_read');
        $transactionOrders =  $this->model->whereSearch($request);

        $transactionOrders = PaginationHelper::paginate(
            $transactionOrders,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $transactionOrders;
    }

    // TODO: Create a transaction order.
    public function createTransactionOrder(array $data)
    {
        CheckPermissionsHelper::checkBrandPermission($data['brand_id'], 'transaction_orders_create');
        return $this->model->createTransactionOrder($data);
    }

    // TODO: Find a transaction order by ID.
    public function findTransactionOrderById($id)
    {
        $transactionOrder= $this->model->findOrFail($id);
        CheckPermissionsHelper::checkBrandPermission($transactionOrder->brand_id, 'transaction_orders_read');
        return $transactionOrder;
    }

    // TODO: Update a transaction order.
    public function updateTransactionOrder(array $data, $id)
    {
        $transactionOrder=$this->model->findOrFail($id);
        CheckPermissionsHelper::checkBrandPermission($transactionOrder->brand_id, 'transaction_orders_update');
        return $this->model->updateTransactionOrder($data, $id);
    }

    // TODO: Delete a transaction order.
    public function deleteTransactionOrder($id)
    {
        $transactionOrder=$this->model->findOrFail($id);
        CheckPermissionsHelper::checkBrandPermission($transactionOrder->brand_id, 'transaction_orders_delete');
        return $transactionOrder->delete();
    }
}