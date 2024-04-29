<?php

namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\GroupTradeOrderInterface;
use App\Models\TradeOrder;
use App\Models\TradingAccount;
use Illuminate\Database\Eloquent\Model;


class GroupTradeOrderRepository implements GroupTradeOrderInterface
{
    private $model;
    private $trading_account;

    public function __construct()
    {
        $this->model = new TradeOrder();
        $this->trading_account = new TradingAccount();
    }

    // TODO: Get all group trade orders.
    public function getAllGroupTradeOrders($request)
    {
        $groupTradeOrders = $this->model
            ->when($request->has('brand_id'), function ($query) use ($request) {
                return $query->whereIn('brand_id', $request->input('brand_id'));
            })
            ->allGroupUniqueId();
        $groupTradeOrders = PaginationHelper::paginate(
            $groupTradeOrders,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $groupTradeOrders;
    }

    // TODO: Create a group trade order.
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

    // TODO: Find a group trade order by its ID.
    public function findGroupTradeOrderById($id)
    {
        return $this->model->findGroupUniqueId($id);
    }

    // TODO: Update a group trade order.
    public function updateGroupTradeOrder(array $data, $id)
    {
        $trading_account_ids = $this->model->whereGroupUniqueId($id)->pluck('id');
        foreach ($trading_account_ids as $trading_account_id) {
            $this->model->updateTradeOrder($data, $trading_account_id);
        }
        return true;
    }

    // TODO: Delete a group trade order.
    public function deleteGroupTradeOrder($id)
    {
        $this->model->findGroupUniqueId($id)->delete();
    }
}

