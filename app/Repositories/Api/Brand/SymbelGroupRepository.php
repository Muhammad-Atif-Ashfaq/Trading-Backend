<?php
namespace App\Repositories\Api\Brand;

use App\Helpers\PaginationHelper;
use App\Helpers\SystemHelper;
use App\Interfaces\Api\Brand\SymbelGroupInterface;
use App\Models\SymbelGroup;


class SymbelGroupRepository implements SymbelGroupInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new SymbelGroup();
    }


    public function getAllSymbelGroupList($request)
    {
        $symbelGroups = $this->model
            ->select('name', 'id','swap','leverage',
                'lot_size',
                'lot_step',
                'vol_min',
                'vol_max'
                )
            ->get();
        return $symbelGroups;
    }


}