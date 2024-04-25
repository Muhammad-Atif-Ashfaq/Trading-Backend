<?php

namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\TradingAccountInterface;
use App\Models\TradingAccount;
use App\Services\GenerateRandomService;
use Carbon\Carbon;

class TradingAccountRepository implements TradingAccountInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new TradingAccount();
    }

    // TODO: Get all trading accounts.
    public function getAllTradingAccounts($request)
    {
        $tradingAccounts = $this->model->when($request->has('status'), function ($query) use ($request) {
            return $query->where('status', $request->status);
        });
        $tradingAccounts = PaginationHelper::paginate(
            $tradingAccounts,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $tradingAccounts;
    }

    // TODO: Get all trading accounts list.
    public function getAllTradingAccountList()
    {
        $tradingAccounts = $this->model
            ->select('login_id', 'id')
            ->get();
        return $tradingAccounts;
    }

    // TODO: Get all trading accounts not in any group.
    public function getAllTradingAccountsNotInGroup()
    {
        $tradingAccounts = $this->model
            ->whereNull('trading_group_id')
            ->select('login_id', 'id')
            ->get();
        return $tradingAccounts;
    }

    // TODO: Create a trading account.
    public function createTradingAccount(array $data)
    {

        $loginId = GenerateRandomService::RandomBrand();
        $tradingAccount = $this->model->create([
            'trading_group_id' => $data['trading_group_id'] ?? null,
            'public_key' => GenerateRandomService::getCustomerPublicKey($data['brand_id']),
            'login_id' => $loginId,
            'password' => $loginId,
            'country' => $data['country'] ?? null,
            'phone'   => $data['phone'] ?? null,
            'name'   => $data['name'] ?? null,
            'email'   => $data['email'],
            'leverage' => $data['leverage'] ?? null,
            'balance' => $data['balance'] ?? null,
            'credit'  => $data['credit'] ?? null,
            'equity'  => $data['equity'] ?? null,
            'profit'  => $data['profit'] ?? null,
            'swap'    => $data['swap'] ?? null,
            'currency' => $data['currency'] ?? null,
            'margin_level_percentage' => $data['margin_level_percentage'] ?? null,
            'registration_time' => Carbon::now(),
            'trading_account_group_id' => $data['trading_account_group_id']  ?? null,
            'brand_id' => $data['brand_id']  ?? null,
            'status'   => $data['status'] ?? null,
            'enable_password_change'   => $data['enable_password_change'] ?? null,
            'enable_investor_trading'   => $data['enable_investor_trading'] ?? null,
            'change_password_at_next_login'   => $data['change_password_at_next_login'] ?? null,
            'enable'   => $data['enable'] ?? null
        ]);


        return $tradingAccount;
    }

    // TODO: Find a trading account by ID.
    public function findTradingAccountById($id)
    {
        return $this->model->findOrFail($id);
    }

    // TODO: Update a trading account.
    public function updateTradingAccount(array $data, $id)
    {
        $tradingAccount = $this->model->findOrFail($id);
        $tradingAccount->update([
            'trading_group_id' => $data['trading_group_id'] ?? $tradingAccount->trading_group_id,
            'name'    => $data['name'] ?? $tradingAccount->name,
            'country' => $data['country'] ??  $tradingAccount->country,
            'phone'   => $data['phone'] ??  $tradingAccount->phone,
            'email'   => $data['email'] ??  $tradingAccount->email,
            'password'   => $data['password'] ??  $tradingAccount->password,
            'leverage' => $data['leverage'] ??  $tradingAccount->leverage,
            'balance' => $data['balance'] ??  $tradingAccount->balance,
            'credit'  => $data['credit'] ??  $tradingAccount->credit,
            'equity'  => $data['equity'] ??  $tradingAccount->equity,
            'profit'  => $data['profit'] ??  $tradingAccount->profit,
            'swap'    => $data['swap'] ??  $tradingAccount->swap,
            'currency' => $data['currency'] ??  $tradingAccount->currency,
            'margin_level_percentage' => $data['margin_level_percentage'] ??  $tradingAccount->margin_level_percentage,
            'trading_account_group_id' => $data['trading_account_group_id '] ??  $tradingAccount->trading_account_group_id,
            'brand_id' => $data['brand_id'] ??  $tradingAccount->brand_id,
            'enable_password_change'   => $data['enable_password_change'] ?? $tradingAccount->enable_password_change,
            'enable_investor_trading'   => $data['enable_investor_trading'] ?? $tradingAccount->enable_investor_trading,
            'change_password_at_next_login'   => $data['change_password_at_next_login'] ?? $tradingAccount->change_password_at_next_login,
            'enable'   => $data['enable'] ?? $tradingAccount->enable,
            'status'   => $data['status'] ?? $tradingAccount->status,
        ]);

        return $tradingAccount;
    }

    // TODO: Delete a trading account.
    public function deleteTradingAccount($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
