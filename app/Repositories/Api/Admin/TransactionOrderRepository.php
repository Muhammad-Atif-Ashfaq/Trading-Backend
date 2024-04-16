<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\TransactionOrderInterface;
use App\Models\TransactionOrder;

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
        $transactionOrders = $this->model->when(isset($request['trading_account_id']), function ($query) use ($request) {
            return $query->where('trading_account_id', $request['trading_account_id']);
        });
        $transactionOrders = PaginationHelper::paginate(
            $transactionOrders,
          isset( $request['per_page']) ? $request['per_page']:config('systemSetting.system_per_page_count'),
          isset( $request['page']) ?  $request['page']:config('systemSetting.system_current_page')
        );
        return $transactionOrders;
    }

    // TODO: Create a transaction order.
    public function createTransactionOrder(array $data)
    {
        return $this->model->createTransactionOrder($data);
    }

    // TODO: Find a transaction order by ID.
    public function findTransactionOrderById($id)
    {
        return $this->model->findOrFail($id);
    }

    // TODO: Update a transaction order.
    public function updateTransactionOrder(array $data, $id)
    {
        return $this->model->updateTransactionOrder($data, $id);
    }

    // TODO: Delete a transaction order.
    public function deleteTransactionOrder($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
