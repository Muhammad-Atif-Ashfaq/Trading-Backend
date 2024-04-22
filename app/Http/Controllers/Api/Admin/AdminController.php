<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ChangePasswordService;
use App\Http\Requests\Api\Admin\ChangePassword\ChangePassword;
use App\Helpers\ExceptionHandlerHelper;

class AdminController extends Controller
{
    public function changePassword(ChangePassword $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = ChangePasswordService::adminChangePassword($request->validated());
            return $this->sendResponse($user, 'Admin password updated successfully');
        });
    }
}
