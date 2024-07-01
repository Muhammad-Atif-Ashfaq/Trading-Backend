<?php

namespace App\Repositories\Api\Brand;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\GroupTransactionOrderInterface;
use App\Models\TransactionOrder;
use App\Models\TradingAccount;


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

        $groupTransactionOrder = $this->model->whereSearch($request)->allGroupUniqueId();
        $groupTransactionOrder = PaginationHelper::paginate(
            $groupTransactionOrder,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $groupTransactionOrder;
    }

    public function createGroupTransactionOrder(array $data)
    {
        $trading_group__id = uniqid($this->model::$PREFIX);
        $trading_accounts = $this->trading_account
            ->where('trading_group_id', $data['trading_group_id'])
            ->when(isset($data['skip']) && $data['skip'] == true, function ($query) use ($data) {
                return $query->whereNotIn('id', function ($subQuery) use ($data) {
                    $subQuery
                        ->select('id')
                        ->from('trading_accounts')
                        ->where('trading_group_id', $data['trading_group_id'])
                        ->where($data['method'], '<', (int)$data['amount'])
                        ->pluck('id');
                });
            })
            ->get();
            $response = [];
        foreach ($trading_accounts as $trading_account) {
            $data['trading_account_id'] = $trading_account->id;
            $data['brand_id'] = $trading_account->brand_id;
            $data['group_unique_id'] = $trading_group__id;
            $response[] = $this->model->createTransactionOrder($data);
        }
        return $response;
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