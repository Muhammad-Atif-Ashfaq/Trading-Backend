<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Models\TradingGroup;


class TradingGroupRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new TradingGroup();

    }

    public function getAllTradingGroups($request)
    {
        $tradingGroups = $this->model->query();
        $tradingGroups = PaginationHelper::paginate(
            $tradingGroups,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_per_page_count'))
        );
        return $tradingGroups;
    }

    public function createTradingGroup(array $data)
    {

        $tradingGroup = $this->model->create([
            'name' => $data['name'],
            'mass_leverage' => $data['mass_leverage'],
            'mass_swap' => $data['mass_swap'],
        ]);


        return $tradingGroup;
    }

    public function findTradingGroupById($id)
    {
        return $this->model->findOrFail($id);
    }

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

    public function deleteTradingGroup($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
