<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Models\SymbelSetting;


class SymbelSettingRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new SymbelSetting();

    }

    public function getAllSymbelSettings($request)
    {
        $symbelSettings = $this->model::query();
        $symbelSettings = PaginationHelper::paginate(
            $symbelSettings,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_per_page_count'))
        );
        return $symbelSettings;
    }

    public function createSymbelSetting(array $data)
    {

        $symbelSetting = $this->model->create([
            'name' => $data['name'],
            'symbel_group_id'  => $data['symbel_group_id'],
            'speed_min' => $data['speed_min'] ?? null,
            'speed_max' => $data['speed_max'] ?? null,
            'lot_size'  => $data['lot_size'] ?? null,
            'lot_step'  => $data['lot_step'] ?? null,
            'commission'=> $data['commission'] ?? null,
            'swap_long' => $data['swap_long'] ?? null,
            'swap_short'=> $data['swap_short'] ?? null,
            'enabled'   => $data['enabled'] ?? 0,
            'viable'    => $data['viable'] ?? 0
        ]);


        return $symbelSetting;
    }

    public function findSymbelSettingById($id)
    {
        return $this->model::findOrFail($id);
    }

    public function updateSymbelSetting(array $data, $id)
    {
        $symbelSetting = $this->model::findOrFail($id);
        $symbelSetting->update([
            'name' => $data['name'] ?? $symbelSetting->name,
            'symbel_group_id'  => $data['symbel_group_id'] ?? $symbelSetting->symbel_group_id,
            'speed_min' => $data['speed_min'] ?? $symbelSetting->speed_min,
            'speed_max' => $data['speed_max'] ?? $symbelSetting->speed_max,
            'lot_size'  => $data['lot_size'] ?? $symbelSetting->lot_size,
            'lot_step'  => $data['lot_step'] ?? $symbelSetting->lot_step,
            'commission'=> $data['commission'] ?? $symbelSetting->commission,
            'swap_long' => $data['swap_long'] ?? $symbelSetting->swap_long,
            'swap_short'=> $data['swap_short'] ?? $symbelSetting->swap_short,
            'enabled'   => $data['enabled'] ?? $symbelSetting->enabled,
            'viable'    => $data['viable'] ?? $symbelSetting->viable
        ]);
        return $symbelSetting;
    }

    public function deleteSymbelSetting($id)
    {
        $this->model::findOrFail($id)->delete();
    }
}
