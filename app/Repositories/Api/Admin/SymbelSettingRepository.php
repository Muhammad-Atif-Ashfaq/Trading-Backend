<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Helpers\SystemHelper;
use App\Interfaces\Api\Admin\SymbelSettingInterface;
use App\Models\SymbelSetting;

class SymbelSettingRepository implements SymbelSettingInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new SymbelSetting();
    }

    // TODO: Get all symbel settings.
    public function getAllSymbelSettings($request)
    {
        $symbelSettings = $this->model->whereSearch($request);

        $symbelSettings = PaginationHelper::paginate(
            $symbelSettings,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $symbelSettings;

    }


    // TODO: Get all symbel settings list.
    public function getAllSymbelSettingList()
    {
        $symbelSettings = $this->model
            ->select(
                'name',
                'feed_name',
                'feed_fetch_name',
                'feed_fetch_key',
                'lot_size',
                'lot_step',
                'vol_min',
                'vol_max',
                'pip',
                'swap',
                'leverage',
                'id',
                'commission',
                'symbel_group_id'
            )
            ->with('group')
            ->get()->makeHidden(['dataFeed']);
        return $symbelSettings;
    }

    // TODO: Create a symbel setting.
    public function createSymbelSetting(array $data)
    {

        $symbelSetting = $this->model->create([
            'name' => $data['name'],
            'symbel_group_id'  => $data['symbel_group_id'],
            'feed_name' => $data['feed_name'],
            'feed_fetch_name' => $data['feed_fetch_name'],
            'feed_fetch_key' => $data['feed_fetch_key'] ?? null,
            'speed_max'  => $data['speed_max'],
            'leverage'=> $data['leverage'],
            'swap' => $data['swap'],
            'lot_size'=> $data['lot_size'],
            'lot_step'=> $data['lot_step'],
            'vol_min'=> $data['vol_min'],
            'vol_max'=> $data['vol_max'],
            'commission'=> $data['commission'],
            'enabled'   => $data['enabled'] ?? 0,
            'pip'   => $data['pip'] ?? 5,

        ]);


        return $symbelSetting;
    }

    // TODO: Find a symbel setting by its ID.
    public function findSymbelSettingById($id)
    {
        return $this->model->findOrFail($id);
    }

    // TODO: Update a symbel setting.
    public function updateSymbelSetting(array $data, $id)
    {
        $symbelSetting = $this->model->findOrFail($id);
        $symbelSetting->update(prepareUpdateCols($data, 'symbel_settings'));
        return $symbelSetting;
    }

    //  TODO: Delete a symbel setting.
    public function deleteSymbelSetting($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
