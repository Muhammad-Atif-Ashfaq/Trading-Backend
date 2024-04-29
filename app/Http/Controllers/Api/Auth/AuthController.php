<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHandlerHelper;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // TODO: Authenticate user and generate token.
    public function login(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success['token'] = $user->createToken('MyApp')->plainTextToken;
                $success['user'] = $user;
                $success['brand'] = Brand::where('user_id',$user->id)->first();
                return $this->sendResponse($success, 'User login successfully.');
            }
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);

        });
    }

    // TODO: Logout the authenticated user.
    public function logout(Request $request) {
        return ExceptionHandlerHelper::tryCatch(function () use($request) {
            $request->user()->currentAccessToken()->delete();
            return $this->sendResponse([], 'User logged out successfully.');
        });
    }
}
