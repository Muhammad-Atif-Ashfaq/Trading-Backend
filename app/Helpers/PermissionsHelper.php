<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;


class PermissionsHelper extends Helper
{
    public static function generateModelPermissions()
    {
        $i = 0;

        $permissionArray[$i]['name']       = 'trading_account_list_read';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'trading_account_list_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'trading_account_list_update';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'trading_account_list_delete';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'trading_account_group_read';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'trading_account_group_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'trading_account_group_update';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'trading_account_group_delete';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'active_account_group_read';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'active_account_group_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'active_account_group_update';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'active_account_group_delete';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'margin_call_trading_read';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'margin_call_trading_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'margin_call_trading_update';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'margin_call_trading_delete';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'live_orders_read';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'live_orders_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'live_orders_update';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'live_orders_delete';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'close_orders_read';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'close_orders_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'close_orders_update';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'close_orders_delete';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'transaction_orders_read';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'transaction_orders_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'transaction_orders_update';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'transaction_orders_delete';
        $permissionArray[$i]['guard_name'] = 'web';

       return Permission::insert($permissionArray);
    }

    public static function generatePermissions(array $permissions){
        $new_permissions =[];
        foreach ($permissions as $permission) {
            if ($permission['read'] == true) {
                $new_permissions[] = $permission['key'] . '_read';
            }
            if ($permission['create'] == true) {
                $new_permissions[] = $permission['key'] . '_create';
            }
            if ($permission['update'] == true) {
                $new_permissions[] = $permission['key'] . '_update';
            }
            if ($permission['del'] == true) {
                $new_permissions[] = $permission['key'] . '_delete';
            }
        }
        return $new_permissions;
    }
}
