<?php

namespace App\Http\Controllers\Api\Terminal;

use App\Helpers\ExceptionHandlerHelper;
use App\Http\Controllers\Controller;
use App\Models\TradingAccount;
use App\Services\TerminalLoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   public function login(Request $request){
       return ExceptionHandlerHelper::tryCatch(function () use($request) {
           $credentials = $request->only('login_id', 'password');
           if(TerminalLoginService::attempt($credentials)){
               $trading_account = TradingAccount::where('login_id',$request->login_id)->first();
               $success['token'] = $trading_account->createToken('MyApp')->plainTextToken;
               $success['trading_account'] = $trading_account;
               return $this->sendResponse($success, 'User login successfully.');
           }
           return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
       });
   }
}
