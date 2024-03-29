<?php

namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Models\TransactionOrder;
use App\Models\TradingAccount;
use Illuminate\Database\Eloquent\Model;


class GroupTransactionOrderRepository
{
    private $model;
    private $trading_account;

    public function __construct()
    {
        $this->model = new TransactionOrder();
        $this->trading_account = new TradingAccount();


    }

    public function getAllGroupTransactionOrder($request)
    {
        $groupTransactionOrder = $this->model->query();
        $groupTransactionOrder = PaginationHelper::paginate(
            $groupTransactionOrder,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_per_page_count'))
        );
        return $groupTransactionOrder;
    }

    public function createGroupTransactionOrder(array $data)
    {
        $trading_group_trade_order_id = uniqid($this->model::$PREFIX);
        $trading_account_ids = $this->trading_account->where('trading_group_id', $data['trading_group_id'])->pluck('id');
        foreach ($trading_account_ids as $trading_account_id) {
            $data['trading_account_id'] = $trading_account_id;
            $data['trading_group_trade_order_id'] = $trading_group_trade_order_id;
            $this->model->createTransactionOrder($data);
        }
    }

    public function findGroupTransactionOrderById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateGroupTransactionOrder(array $data, $id)
    {
        return $this->model->updateTransactionOrder($data, $id);
    }

    public function deleteGroupTransactionOrder($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}

