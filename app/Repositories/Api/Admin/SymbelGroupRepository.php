<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Helpers\SystemHelper;
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
        $symbelGroups = $this->model->whereSearch($request);
        $symbelGroups = PaginationHelper::paginate(
            $symbelGroups,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $symbelGroups;
    }

    // TODO: Get all symbel groups list.
    public function getAllSymbelGroupList($request)
    {
        $symbelGroups = $this->model
            ->select('name', 'id','swap','leverage',
                'lot_size',
                'lot_step',
                'vol_min',
                'vol_max'
                )
            ->when($request->has('skipRow'),function ($q) use ($request){
                $q->whereNotIn('id',$request->input('skipRow',[]));
            })
            ->with('settings')
            ->get();
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
            'trading_interval' => $data['trading_interval'] ?? null,
            'swap'     => $data['swap']
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
        $symbelGroup->update(prepareUpdateCols($data, 'symbel_groups'));
        return $symbelGroup;
    }

    // TODO: Delete a symbel group.
    public function deleteSymbelGroup($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
