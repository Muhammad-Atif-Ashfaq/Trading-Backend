<?php

namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\GroupTransactionOrderInterface;
use App\Models\TransactionOrder;
use App\Models\TradingAccount;
use Illuminate\Database\Eloquent\Model;


class GroupTransactionOrderRepository implements GroupTransactionOrderInterface
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
        $groupTransactionOrder = $this->model
            ->when($request->has('brand_id'), function ($query) use ($request) {
                return $query->whereIn('brand_id', $request->input('brand_id'));
            })
            ->allGroupUniqueId();
        $groupTransactionOrder = PaginationHelper::paginate(
            $groupTransactionOrder,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $groupTransactionOrder;
    }

    public function createGroupTransactionOrder(array $data)
    {
        $trading_group_trade_order_id = uniqid($this->model::$PREFIX);
        $trading_account_ids = $this->trading_account->where('trading_group_id', $data['trading_group_id'])->pluck('id');
        foreach ($trading_account_ids as $trading_account_id) {
            $data['trading_account_id'] = $trading_account_id;
            $data['group_unique_id'] = $trading_group_trade_order_id;
            $this->model->createTransactionOrder($data);
        }
    }

    public function findGroupTransactionOrderById($id)
    {
        return $this->model->findGroupUniqueId($id);
    }

    public function updateGroupTransactionOrder(array $data, $id)
    {
        $trading_account_ids = $this->model->whereGroupUniqueId($id)->pluck('id');
        foreach ($trading_account_ids as $trading_account_id) {
            $this->model->updateTransactionOrder($data, $trading_account_id);
        }
        return true;
    }

    public function deleteGroupTransactionOrder($id)
    {
        $this->model->whereGroupUniqueId($id)->delete();
    }
}
