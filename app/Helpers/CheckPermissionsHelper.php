<?php
namespace App\Helpers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermissionsHelper
{
    public static function checkBrandPermission($brand_id, $permission)
    {
        $brand = Brand::where('public_key',$brand_id)->first();
        $user = $brand->user;
        if (!$user->can($permission)) {
            abort(403, 'Unauthorized');
        }
    }
}