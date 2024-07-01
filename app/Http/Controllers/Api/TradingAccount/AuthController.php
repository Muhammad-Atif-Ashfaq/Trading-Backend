<?php

namespace App\Http\Controllers\Api\TradingAccount;

use App\Helpers\ExceptionHandlerHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\TradingAccount\Auth\LoginTrait;
use App\Traits\TradingAccount\Auth\RegisterTrait;
use App\Http\Requests\Api\TradingAccount\Auth\ChangePassword;
use App\Traits\ResponseTrait;
use App\Services\ChangePasswordService;
use Auth;

class AuthController extends Controller
{
    use ResponseTrait,
        RegisterTrait,
        LoginTrait;

    public function profile()
    {
        return ExceptionHandlerHelper::tryCatch(function () {
            $user=Auth::user();
            return $this->sendResponse($user, 'User Profile');
        });
    }

    public function logout()
    {
        return ExceptionHandlerHelper::tryCatch(function () {
            $user=Auth::user();
            return $this->sendResponse($user->tokens()->delete(),
                'User Logout  Successfully'
            );
        });
    }

    public function changePassword(ChangePassword $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = ChangePasswordService::adminChangePassword($request->validated());
            return $this->sendResponse($user, 'Password updated successfully');
        });
    }
}