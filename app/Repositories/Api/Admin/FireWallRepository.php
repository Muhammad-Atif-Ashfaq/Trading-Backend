<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\FireWallInterface;
use App\Models\IpList;

class FireWallRepository implements FireWallInterface
{
    private $ip;

    public function __construct()
    {
        $this->ip = new IpList();
    }

    // TODO: Get all is_list.
    public function getAllIpLists($request)
    {
        $is_list = $this->ip->whereSearch($request);
        $is_list = PaginationHelper::paginate(
            $is_list,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $is_list;
    }


    // TODO: Get add to ip_list.
    public function addToIpList($request)
    {
        return $this->ip->add($request);
    }
}
