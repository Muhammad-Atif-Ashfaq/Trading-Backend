<?php

namespace App\Repositories\Api\Brand;

use App\Helpers\CheckPermissionsHelper;
use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Brand\TradingGroupInterface;
use App\Models\TradingAccount;
use App\Models\TradingGroup;
use App\Models\TradingGroupSymbol;

class TradingGroupRepository implements TradingGroupInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new TradingGroup();
        $this->trading_account = new TradingAccount();
        $this->trading_group_symbol = new TradingGroupSymbol();
    }

    // TODO: Get all trading groups.
    public function getAllTradingGroups($request)
    {
        CheckPermissionsHelper::checkBrandPermission($request['brand_id'], 'trading_account_group_read');
        $tradingGroups = $this->model->whereSearch($request);
        $tradingGroups = PaginationHelper::paginate(
            $tradingGroups,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );

        return $tradingGroups;
    }

    // TODO: Get all trading groups list.
    public function getAllTradingGroupList($request)
    {
        CheckPermissionsHelper::checkBrandPermission($request['brand_id'], 'trading_account_group_read');
        $tradingGroups = $this->model->whereSearch($request)
            ->select('name', 'id')
            ->get()->makeHidden(['symbelGroups', 'tradingAccounts']);

        return $tradingGroups;
    }

    // TODO: Create a trading group.
    public function createTradingGroup(array $data)
    {
        CheckPermissionsHelper::checkBrandPermission($data['brand_id'], 'trading_account_group_create');
        $tradingGroup = $this->model->create([
            'name' => $data['name'],
            'mass_leverage' => $data['mass_leverage'],
            'mass_swap' => $data['mass_swap'],
            'brand_id' => $data['brand_id'],
        ]);
        if ($tradingGroup) {
            $group = $this->model::find($tradingGroup->id);
            if (count($data['symbel_group_ids'])) {
                foreach ($data['symbel_group_ids'] as $value) {
                    $group->symbelGroups()->attach($value);
                }
            }
            if (isset($data['trading_account_ids']) && count($data['trading_account_ids'])) {
                foreach ($data['trading_account_ids'] as $value) {
                    $trading_account = $this->trading_account->find($value);
                    $trading_account->trading_group_id = $tradingGroup->id;
                    $trading_account->save();
                }
            }

        }
        pushLiveDate('trading_groups', 'create', prepareExportData($this->model, [$tradingGroup])[0]);

        return $tradingGroup;
    }

    // TODO: Find a trading group by ID.
    public function findTradingGroupById($id)
    {
        $tradingGroup = $this->model->findOrFail($id);
        CheckPermissionsHelper::checkBrandPermission($tradingGroup->brand_id, 'trading_account_group_read');

        return $tradingGroup;
    }

    //  TODO: Update a trading group.
    public function updateTradingGroup(array $data, $id)
    {
        $tradingGroup = $this->model->findOrFail($id);
        CheckPermissionsHelper::checkBrandPermission($tradingGroup->brand_id, 'trading_account_group_update');
        $tradingGroup->update(prepareUpdateCols($data, 'trading_groups'));
        if (isset($data['symbel_group_ids']) && count($data['symbel_group_ids'])) {
            foreach ($data['symbel_group_ids'] as $value) {
                $trading_group_symbel = $this->trading_group_symbol->where('trading_group_id', $tradingGroup->id);
                if ($trading_group_symbel->exists()) {
                    $trading_group_symbel->delete();
                }
                $tradingGroup->symbelGroups()->attach($value);
            }
        }
        if (isset($data['trading_account_ids']) && count($data['trading_account_ids'])) {
            foreach ($data['trading_account_ids'] as $value) {
                $trading_account = $this->trading_account->find($value);
                $trading_account->trading_group_id = $tradingGroup->id;
                $trading_account->save();
            }
        }
        pushLiveDate('trading_groups', 'update', prepareExportData($this->model, [$this->model->findOrFail($id)])[0]);

        return $tradingGroup;
    }

    //  TODO: Delete a trading group.
    public function deleteTradingGroup($id)
    {
        $tradingGroup = $this->model->findOrFail($id);
        CheckPermissionsHelper::checkBrandPermission($tradingGroup->brand_id, 'trading_account_group_delete');
        $this->trading_group_symbol->where('trading_group_id', $id)->delete();
        $this->trading_account->where('trading_group_id', $id)->update([
            'trading_group_id' => null,
        ]);

        return $this->model->findOrFail($id)->delete();
    }
}
