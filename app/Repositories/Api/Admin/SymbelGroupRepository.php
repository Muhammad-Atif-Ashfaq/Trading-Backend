<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\SymbelGroupInterface;
use App\Models\SymbelGroup;


class SymbelGroupRepository implements SymbelGroupInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new SymbelGroup();
    }

    //  TODO: Get all symbel groups.
    public function getAllSymbelGroups($request)
    {
        $symbelGroups = $this->model->query();
        $symbelGroups = PaginationHelper::paginate(
            $symbelGroups,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $symbelGroups;
    }

    // TODO: Create a symbel group.
    public function createSymbelGroup(array $data)
    {

        $symbelGroup = $this->model->create([
            'name'   =>   $data['name'],
            'leverage' => $data['leverage'],
            'lot_size' => $data['lot_size'],
            'lot_step' => $data['lot_step'],
            'vol_min'  => $data['vol_min'],
            'vol_max'  => $data['vol_max'],
            'trading_interval' => $data['trading_interval'] ?? null
        ]);


        return $symbelGroup;
    }

    // TODO: Find a symbel group by its ID.
    public function findSymbelGroupById($id)
    {
        return $this->model->findOrFail($id);
    }

    // TODO: Update a symbel group.
    public function updateSymbelGroup(array $data, $id)
    {
        $symbelGroup = $this->model->findOrFail($id);
        $symbelGroup->update([
            'name'   =>   $data['name'] ?? $symbelGroup->name,
            'Leverage' => $data['leverage'] ?? $symbelGroup->leverage,
            'lot_size' => $data['lot_size'] ?? $symbelGroup->lot_size,
            'lot_step' => $data['lot_step'] ?? $symbelGroup->lot_step,
            'vol_min'  => $data['vol_min'] ?? $symbelGroup->vol_min,
            'vol_max'  => $data['vol_max'] ?? $symbelGroup->vol_max,
            'trading_interval' => $data['trading_interval'] ?? $symbelGroup->trading_interval
        ]);
        return $symbelGroup;
    }

    // TODO: Delete a symbel group.
    public function deleteSymbelGroup($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
