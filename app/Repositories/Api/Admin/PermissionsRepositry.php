<?php

namespace App\Repositories\Api\Admin;


use App\Helpers\PermissionsHelper;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
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
        $user = $this->model->find($data['user_id']);

        if ($user) {
            // Detach existing permissions using custom SQL query
            DB::table('model_has_permissions')->where('model_type', get_class($user))->where('model_id', $user->id)->delete();

            $permissions = Permission::whereIn('name', PermissionsHelper::generatePermissions($data['permissions']))->get();

            if ($permissions->isNotEmpty()) {
                // Attach new permissions using custom SQL query
                foreach ($permissions as $permission) {
                    DB::table('model_has_permissions')->insert([
                        'permission_id' => $permission->id,
                        'model_type' => get_class($user),
                        'model_id' => $user->id
                    ]);
                }
                return $permissions; // Return the permissions assigned to the user
            } else {
                return []; // Return an empty array if no permissions were found or assigned
            }
        }

        return false; // Return false if the user is not found
    }


}
