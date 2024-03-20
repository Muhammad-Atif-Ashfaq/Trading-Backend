<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Services\GenerateRandomService;
use Illuminate\Http\Request;
use App\Models\TradingAccount;
use Carbon\Carbon;

class TradingAccountController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new TradingAccount();
    }


    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request){
            $accounts = $this->model::query();
            $accounts = PaginationHelper::paginate(
                $accounts,
                $request->input('per_page', 10),
                $request->input('page', 1)
            );
            return $this->sendResponse($accounts, 'All Accounts');
        });
    }

    public function store(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $account = $this->model::create([
                'user_id'    => $request->user_id,
                'trading_group_id' => $request->trading_group_id,
                'public_key' => GenerateRandomService::getCustomerPublicKey($request->brand_id),
                'login_id' => GenerateRandomService::RandomBrand(),
                'password' => GenerateRandomService::RandomSixString(),
                'country' => $request->country,
                'phone'   => $request->phone,
                'email'   => $request->email,
                'leverage' => $request->leverage,
                'balance' => $request->balance,
                'credit'  => $request->credit,
                'equity'  => $request->equity,
                'profit'  => $request->profit,
                'swap'    => $request->swap,
                'currency' => $request->currency,
                'margin_level_percentage' => $request->margin_level_percentage,
                'registration_time' => Carbon::now(),
                'trading_account_group_id' => $request->trading_account_group_id,
                'brand_id' => $request->brand_id,
                'status'   => $request->status
            ]);
            if ($account) {
                return $this->sendResponse($account, 'Account Store Successfully');
            }
        });
    }

    public function show(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $accounts = $this->model::find($id);
            return $this->sendResponse($accounts, 'Single Accounts');
        });
    }


    public function update(Request $request, string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $accounts = $this->model::find($id);
            $update = $accounts->update([
                'user_id'    => $request->user_id ?? $accounts->user_id,
                'trading_group_id' => $request->trading_group_id ?? $accounts->trading_group_id,
                'name'    => $request->name ?? $accounts->name,
                'country' => $request->country ??  $accounts->country,
                'phone'   => $request->phone ??  $accounts->phone,
                'email'   => $request->email ??  $accounts->email,
                'leverage' => $request->leverage ??  $accounts->leverage,
                'balance' => $request->balance ??  $accounts->balance,
                'credit'  => $request->credit ??  $accounts->credit,
                'equity'  => $request->equity ??  $accounts->equity,
                'profit'  => $request->profit ??  $accounts->profit,
                'swap'    => $request->swap ??  $accounts->swap,
                'currency' => $request->currency ??  $accounts->currency,
                'margin_level_percentage' => $request->margin_level_percentage ??  $accounts->margin_level_percentage,
                'trading_account_group_id' => $request->trading_account_group_id ??  $accounts->trading_account_group_id,
                'brand_id' => $request->brand_id ??  $accounts->brand_id,
                'status'   => $request->status ?? $account->status
            ]);
            if ($update) {
                return $this->sendResponse($accounts, 'Account Updated');
            }
        });
    }

    public function destroy(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $accounts = $this->model::find($id)->delete();
            return $this->sendResponse($accounts, 'Accounts Deleted');
        });
    }
}