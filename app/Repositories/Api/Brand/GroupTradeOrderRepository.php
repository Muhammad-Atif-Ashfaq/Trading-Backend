<?php

namespace App\Repositories\Api\Brand;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\GroupTradeOrderInterface;
use App\Models\TradeOrder;
use App\Models\TradingAccount;



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

        $groupTradeOrders = $this->model->whereSearch($request)->allGroupUniqueId();
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
        $trading_group__id = uniqid($this->model::$PREFIX);
        $trading_accounts = $this->trading_account
            ->where('trading_group_id', $data['trading_group_id'])
            ->when(isset($data['skip']) && $data['skip'] == true, function ($query) use ($data) {
                $query->whereNotIn('id', function ($subQuery) use ($data) {
                    $subQuery->select('id')
                        ->from('trading_accounts')
                        ->where('trading_group_id', $data['trading_group_id'])
                        ->where('balance', '>', 0)
                        ->whereIn('id', function ($innerSubQuery) use ($data) {
                            $innerSubQuery->select('trading_accounts.id')
                                ->from('trading_accounts')
                                ->where('trading_group_id', $data['trading_group_id'])
                                ->join('brands', 'brands.public_key', '=', 'trading_accounts.brand_id')
                                ->whereColumn('brands.stop_out', '>', 'trading_accounts.margin_level_percentage');
                        });
                });
            })
            ->get();

        foreach ($trading_accounts as $trading_account) {
            $data['trading_account_id'] = $trading_account->id;
            $data['brand_id'] = $trading_account->brand_id;
            $data['group_unique_id'] = $trading_group__id;
            $this->model->createTradeOrder($data);
        }
        return true;
    }

    // TODO: Find a group trade order by its ID.
    public function findGroupTradeOrderById($tradeOrder)
    {
        return $this->model->findGroupUniqueId($tradeOrder->group_unique_id);
    }

    // TODO: Update a group trade order.
    public function updateGroupTradeOrder(array $data, $tradeOrder)
    {
        $trading_account_ids = $this->model->whereGroupUniqueId($tradeOrder->group_unique_id)->pluck('id');
        foreach ($trading_account_ids as $trading_account_id) {
            $this->model->updateTradeOrder($data, $trading_account_id);
        }
        return true;
    }

    // TODO: Delete a group trade order.
    public function deleteGroupTradeOrder($tradeOrder)
    {
        $this->model->findGroupUniqueId($tradeOrder->group_unique_id)->delete();
    }
}