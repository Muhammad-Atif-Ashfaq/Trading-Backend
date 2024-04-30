<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;


class PermissionsHelper extends Helper
{
    public static function generateModelPermissions($permission)
    {
        $permission = Permission::updateOrCreate(
            ['name' => $permission['model_permission']],
            [ 
                'guard_name' => 'web',
                'create'     => $permission['create'],
                'read'     => $permission['read'],
                'update'     => $permission['update'],
                'delete'     => $permission['delete'],
                ]);
        return $permission;
    }
}