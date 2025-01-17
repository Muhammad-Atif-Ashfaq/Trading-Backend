<?php

namespace App\Repositories\Api\Brand;

use App\Helpers\CheckPermissionsHelper;
use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Brand\TradingAccountInterface;
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
        CheckPermissionsHelper::checkBrandPermission($request['brand_id'], 'trading_account_list_read');
        $tradingAccounts = $this->model->whereSearch($request);
        $tradingAccounts = PaginationHelper::paginate(
            $tradingAccounts,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );

        return $tradingAccounts;
    }

    // TODO: Get all trading accounts list.
    public function getAllTradingAccountList($request)
    {
        CheckPermissionsHelper::checkBrandPermission($request['brand_id'], 'trading_account_list_read');
        $tradingAccounts = $this->model

            ->whereSearch($request)
            ->select('login_id', 'id')
            ->get()->makeHidden(['brand', 'brandCustomer']);

        return $tradingAccounts;
    }

    // TODO: Get all trading accounts not in any group.
    public function getAllTradingAccountsNotInGroup($request)
    {
        $tradingAccounts = $this->model
            ->when($request->has('brand_id'), function ($query) use ($request) {
                return $query->where('brand_id', $request->input('brand_id'));
            })
            ->whereNull('trading_group_id')
            ->select('login_id', 'id')
            ->get()->makeHidden(['brand', 'brandCustomer']);

        return $tradingAccounts;
    }

    // TODO: Create a trading account.
    public function createTradingAccount(array $data)
    {
        CheckPermissionsHelper::checkBrandPermission($data['brand_id'], 'trading_account_list_create');
        $loginId = GenerateRandomService::CustomerId();
        $password = GenerateRandomService::RandomStr(6);
        $tradingAccount = $this->model->create([
            'trading_group_id' => $data['trading_group_id'] ?? null,
            'brand_customer_id' => $data['brand_customer_id'] ?? null,
            'public_key' => GenerateRandomService::getCustomerPublicKey($data['brand_id']),
            'login_id' => $loginId,
            'password' => $password,
            'country' => $data['country'] ?? null,
            'phone' => $data['phone'] ?? null,
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'leverage' => $data['leverage'] ?? 1,
            'balance' => $data['balance'] ?? 0,
            'credit' => $data['credit'] ?? 0,
            'equity' => $data['equity'] ?? null,
            'profit' => $data['profit'] ?? 0,
            'swap' => $data['swap'] ?? null,
            'currency' => $data['currency'] ?? null,
            'margin_level_percentage' => $data['margin_level_percentage'] ?? 0,
            'free_margin' => $data['free_margin'] ?? 0,

            'groups_leverage' => $data['groups_leverage'] ?? null,
            'registration_time' => $data['registration_time'] ?? Carbon::now(),
            'trading_account_group_id' => $data['trading_account_group_id'] ?? null,
            'brand_id' => $data['brand_id'],
            'status' => $data['status'] ?? 'active',
            'enable_password_change' => $data['enable_password_change'] ?? 0,
            'enable_investor_trading' => $data['enable_investor_trading'] ?? 0,
            'change_password_at_next_login' => $data['change_password_at_next_login'] ?? 0,
            'enable' => $data['enable'] ?? 0,
        ]);

        pushLiveDate('trading_accounts', 'create', prepareExportData($this->model, [$tradingAccount])[0]);

        return $tradingAccount;
    }

    // TODO: Find a trading account by ID.
    public function findTradingAccountById($id)
    {
        $tradingAccount = $this->model->findOrFail($id);
        CheckPermissionsHelper::checkBrandPermission($tradingAccount->brand_id, 'trading_account_list_read');

        return $tradingAccount;
    }

    // TODO: Update a trading account.
    public function updateTradingAccount(array $data, $id)
    {
        $tradingAccount = $this->model->findOrFail($id);
        CheckPermissionsHelper::checkBrandPermission($tradingAccount->brand_id, 'trading_account_list_update');
        $tradingAccount->update(prepareUpdateCols($data, 'trading_accounts'));

        pushLiveDate('trading_accounts', 'update', prepareExportData($this->model, [$this->model->findOrFail($id)])[0]);

        return $tradingAccount;
    }

    // TODO: Delete a trading account.
    public function deleteTradingAccount($id)
    {
        $tradingAccount = $this->model->findOrFail($id);
        CheckPermissionsHelper::checkBrandPermission($tradingAccount->brand_id, 'trading_account_list_delete');
        $this->model->findOrFail($id)->delete();
    }
}
