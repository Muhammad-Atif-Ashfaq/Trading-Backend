<?php

namespace App\Traits\TradingAccount\Auth;

use App\Helpers\ExceptionHandlerHelper;
use App\Http\Requests\Api\TradingAccount\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


trait LoginTrait
{


    public function login(LoginRequest $loginRequest)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($loginRequest) {
            if (!Auth::attempt($loginRequest->only(['email', 'password']))) {
                return $this->sendError('Email & Password does not match with our record.',
                    [],
                    401
                );
            }

            $user = User::where('email', $loginRequest->email)->first();

                $success['token'] = $user->createToken("API TOKEN")->plainTextToken;
                $success['user'] = $user;

                return $this->sendResponse($success, 'User Logged In Successfully');


        });

    }
}
