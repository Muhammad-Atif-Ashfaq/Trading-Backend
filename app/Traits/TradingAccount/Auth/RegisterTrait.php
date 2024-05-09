<?php

namespace App\Traits\TradingAccount\Auth;

use App\Helpers\ExceptionHandlerHelper;
use App\Http\Requests\Api\TradingAccount\Auth\RegisterRequest;
use App\Models\Role;
use App\Models\User;


trait RegisterTrait
{
    public function register(RegisterRequest $registerRequest)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($registerRequest) {
            $array = $registerRequest->only(app(User::class)->getFillable());
            $array['original_password'] = $array['password'];
            $user = User::create($array);
            $user->assignRole(Role::BRAND_CUSTOMER);
            return $this->sendResponse($user, 'User Register Successfully');
        });
    }
}
