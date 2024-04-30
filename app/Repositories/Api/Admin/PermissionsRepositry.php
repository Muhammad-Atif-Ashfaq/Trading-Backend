<?php

namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Helpers\PermissionsHelper;
use App\Models\User;
use Str;

class PermissionsRepositry
{
    private $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function assign_permission(array $data)
    {
        $user = $this->model::find($data['brand_id']);
        if($user)
        {
            $permission = PermissionsHelper::generateModelPermissions($data);
            return $user->givePermissionTo($permission);
        }
    }
}
