<?php

namespace App\Http\Controllers\Api\Brand;

use App\Http\Controllers\Controller;
use App\Services\ChangePasswordService;
use App\Http\Requests\Api\Brand\ChangePassword\ChangePassword;
use App\Helpers\ExceptionHandlerHelper;

class BrandController extends Controller
{
    public function changePassword(ChangePassword $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = ChangePasswordService::adminChangePassword($request->validated());
            return $this->sendResponse($user, 'Admin password updated successfully');
        });
    }
}
