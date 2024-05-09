<?php

namespace App\Http\Controllers\Api\TradingAccount;

use App\Helpers\ExceptionHandlerHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\TradingAccount\Auth\LoginTrait;
use App\Traits\TradingAccount\Auth\RegisterTrait;
use App\Traits\ResponseTrait;

class AuthController extends Controller
{
    use ResponseTrait,
        RegisterTrait,
        LoginTrait;

    public function profile(User $user)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($user) {
            return $this->sendResponse($user, 'User Profile');
        });
    }

    public function logout(User $user)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($user) {
            return $this->sendResponse($user->tokens()->delete(),
                'User Logout  Successfully'
            );
        });
    }
}
