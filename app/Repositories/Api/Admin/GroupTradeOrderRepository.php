<?php

namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Models\TradeOrder;
use App\Models\TradingAccount;
use Illuminate\Database\Eloquent\Model;


class GroupTradeOrderRepository
{
    private $model;
    private $trading_account;

    public function __construct()
    {
        $this->model = new TradeOrder();
        $this->trading_account = new TradingAccount();


    }

    public function getAllGroupTradeOrders($request)
    {
        $groupTradeOrders = $this->model->query();
        $groupTradeOrders = PaginationHelper::paginate(
            $groupTradeOrders,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $groupTradeOrders;
    }

    public function createGroupTradeOrder(array $data)
    {
        $trading_group_trade_order_id = uniqid($this->model::$PREFIX);
        $trading_account_ids = $this->trading_account->where('trading_group_id', $data['trading_group_id'])->pluck('id');
        foreach ($trading_account_ids as $trading_account_id) {
            $data['trading_account_id'] = $trading_account_id;
            $data['trading_group_trade_order_id'] = $trading_group_trade_order_id;
            $this->model->createTradeOrder($data);
        }
        return true;
    }

    public function findGroupTradeOrderById($id)
    {
        return $this->model->scopeFindGroupUniqueId($id);
    }

    public function updateGroupTradeOrder(array $data, $id)
    {
        $trading_account_ids = $this->model->scopeWhereGroupUniqueId($id)->pluck('id');
        foreach ($trading_account_ids as $trading_account_id) {
            $this->model->updateTradeOrder($data, $trading_account_id);
        }
        return true;
    }

    public function deleteGroupTradeOrder($id)
    {
        $this->model->scopeFindGroupUniqueId($id)->delete();
    }
}

