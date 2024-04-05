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
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $transactionOrders;
    }

    public function createTransactionOrder(array $data)
    {
        return $this->model->createTransactionOrder($data);
    }

    public function findTransactionOrderById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateTransactionOrder(array $data, $id)
    {
        return $this->model->updateTransactionOrder($data, $id);
    }

    public function deleteTransactionOrder($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
