<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\{PermissionsHelper, ExceptionHandlerHelper};
use App\Repositories\Api\Admin\PermissionsRepositry;
use App\Http\Requests\Api\Admin\Permission\Create as PermissionRequest;

class PermissionController extends Controller
{
    protected $permissionsRepositry;

    public function __construct(PermissionsRepositry $permissionsRepositry)
    {
        $this->permissionsRepositry = $permissionsRepositry;
    }

    public function assign_permission(PermissionRequest $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $data = $this->permissionsRepositry->assign_permission($request->validated());
            return $this->sendResponse($data, 'permissions assign to the user successfully');
        });
    }
}
