<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\TradingGroupInterface;
use App\Models\TradingGroup;

class TradingGroupRepository implements TradingGroupInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new TradingGroup();
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
            foreach ($data['symbel_group_id'] as  $value) {
                $group->symbelGroup()->attach($value);
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
        return $tradingGroup;
    }

    //  TODO: Delete a trading group.
    public function deleteTradingGroup($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
