<?php

namespace App\Http\Controllers\Api\Terminal;

use App\Helpers\ExceptionHandlerHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Terminal\Auth\LoginRequest;
use App\Models\Brand;
use App\Models\TradingAccount;
use App\Services\TerminalLoginService;

class LoginController extends Controller
{
    // TODO: Attempt to authenticate the user and generate a token for the terminal.
    public function login(LoginRequest $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $credentials = $request->only('login_id', 'password');
            if (TerminalLoginService::attempt($credentials)) {
                $trading_account = TradingAccount::where('login_id', $request->login_id)->first();
                $success['token'] = $trading_account->createToken('MyApp')->plainTextToken;
                $success['trading_account'] = $trading_account;

                $trading_account->logLoginActivity();

                return $this->sendResponse($success, 'User login successfully.');
            }

            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        });
    }

    public function isValidBrand(Brand $brandPublicKey, Brand $brandDomain)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($brandPublicKey, $brandDomain) {
            if ($brandPublicKey->id == $brandDomain->id) {
                return $this->sendResponse($brandPublicKey, 'This brand is valid');
            }

            return $this->sendError('This brand is not valid.', ['error' => 'This brand is not valid'], 302);
        });
    }
}
