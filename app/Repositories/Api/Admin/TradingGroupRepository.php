<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\TradingGroupInterface;
use App\Models\{TradingAccount, TradingGroupSymbol, TradingGroup};



class TradingGroupRepository implements TradingGroupInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new TradingGroup();
        $this->trading_account = new TradingAccount();
    }

    // TODO: Get all trading groups.
    public function getAllTradingGroups($request)
    {
        $tradingGroups = $this->model->query();
        $tradingGroups = PaginationHelper::paginate(
            $tradingGroups,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $tradingGroups;
    }

    // TODO: Get all trading groups list.
    public function getAllTradingGroupList()
    {
        $tradingGroups = $this->model
            ->select('name', 'id')
            ->get();
        return $tradingGroups;
    }

    // TODO: Create a trading group.
    public function createTradingGroup(array $data)
    {
        $tradingGroup = $this->model->create([
            'name' => $data['name'],
            'mass_leverage' => $data['mass_leverage'],
            'mass_swap' => $data['mass_swap'],
        ]);
        if($tradingGroup)
        {
            $group = $this->model::find($tradingGroup->id);
            if(count($data['symbel_group_ids'])){
                foreach ($data['symbel_group_ids'] as  $value) {
                    $group->symbelGroups()->attach($value);
                }
            }
            if(count($data['trading_account_ids'])){
                foreach ($data['trading_account_ids'] as  $value) {
                    $trading_account = $this->trading_account->find($value);
                    $trading_account->trading_group_id = $tradingGroup->id;
                    $trading_account->save();
                }
            }

        }
        return $tradingGroup;
    }

    // TODO: Find a trading group by ID.
    public function findTradingGroupById($id)
    {
        return $this->model->findOrFail($id);
    }

    //  TODO: Update a trading group.
    public function updateTradingGroup(array $data, $id)
    {
        $tradingGroup = $this->model->findOrFail($id);
        $tradingGroup->update([
            'name' => $data['name'] ?? $tradingGroup->name,
            'mass_leverage' => $data['mass_leverage'] ?? $tradingGroup->mass_leverage,
            'mass_swap' => $data['mass_swap'] ?? $tradingGroup->mass_swap,
        ]);
        if(count($data['symbel_group_ids'])){
            foreach ($data['symbel_group_ids'] as  $value) {
                $trading_group_symbel = TradingGroupSymbol::where('trading_group_id', $tradingGroup->id);

                if ($trading_group_symbel->exists()) {
                    $trading_group_symbel->delete();
                }
                $tradingGroup->symbelGroups()->attach($value);
            }
        }
        if(count($data['trading_account_ids'])){
            foreach ($data['trading_account_ids'] as  $value) {
                $trading_account = $this->trading_account->find($value);
                $trading_account->trading_group_id = $tradingGroup->id;
                $trading_account->save();
            }
        }
        return $tradingGroup;
    }

    //  TODO: Delete a trading group.
    public function deleteTradingGroup($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}