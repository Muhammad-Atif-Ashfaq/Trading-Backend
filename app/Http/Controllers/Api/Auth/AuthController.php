<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\IpList;
use App\Models\UserLoginActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as SupportRequest;
use App\Helpers\ExceptionHandlerHelper;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // TODO: Authenticate user and generate token.
    public function login(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $login = $request->input('email');
            $type = filter_var($login , FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
            if (Auth::attempt([$type => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $brand = Brand::where('user_id', $user->id)->first();
                // TODO::Check if user is an admin or if the IP address is in the allowed list
                $ipAllowed = $this->isIpAllowed(SupportRequest::ip(), $brand);
                if ($user->hasRole('admin') || $ipAllowed) {
                    $success['token'] = $user->createToken('MyApp')->plainTextToken;
                    $success['user'] = $user;
                    $success['brand'] = $brand;
                    return $this->sendResponse($success, 'User login successfully.');
                } else {
                    return $this->sendError('You are not allowed to login from this IP address.', ['error' => 'Unauthorized']);
                }
            }
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);

        });
    }

    // TODO: Logout the authenticated user.
    public function logout(Request $request) {
        return ExceptionHandlerHelper::tryCatch(function () use($request) {
            $request->user()->currentAccessToken()->delete();
            $this->updateLogoutTime($request->user()->id);
            return $this->sendResponse([], 'User logged out successfully.');
        });
    }

    protected function updateLogoutTime($userId)
    {
        $lastLoginActivity = UserLoginActivity::where('user_id', $userId)
            ->orderBy('login_time', 'desc')
            ->first();

        if ($lastLoginActivity) {
            $lastLoginActivity->logout_time = now();
            $lastLoginActivity->save();
        }
    }
    protected function isIpAllowed($ip, $brand)
    {
        return !empty($brand) ? IpList::where('ip_address', $ip)
            ->where('brand_id', $brand->public_key)
            ->where('status', 'Yes')
            ->exists(): false;
    }
}
