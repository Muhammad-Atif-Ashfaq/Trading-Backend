<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Models\TradingAccount;
use App\Services\GenerateRandomService;
use Carbon\Carbon;


class TradingAccountRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new TradingAccount();

    }

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

    public function createTradingAccount(array $data)
    {

        $loginId = GenerateRandomService::RandomBrand();
        $tradingAccount = $this->model->create([
            'trading_group_id' => $data['trading_group_id'],
            'public_key' => GenerateRandomService::getCustomerPublicKey($data['brand_id']),
            'login_id' => $loginId,
            'password' => $loginId,
            'country' => $data['country'],
            'phone'   => $data['phone'],
            'email'   => $data['email'],
            'leverage' => $data['leverage'],
            'balance' => $data['balance'],
            'credit'  => $data['credit'],
            'equity'  => $data['equity'],
            'profit'  => $data['profit'],
            'swap'    => $data['swap'],
            'currency' => $data['currency'],
            'margin_level_percentage' => $data['margin_level_percentage'],
            'registration_time' => Carbon::now(),
            'trading_account_group_id' => $data['trading_account_group_id'],
            'brand_id' => $data['brand_id'],
            'status'   => $data['status']
        ]);


        return $tradingAccount;
    }

    public function findTradingAccountById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateTradingAccount(array $data, $id)
    {
        $tradingAccount = $this->model->findOrFail($id);
        $tradingAccount->update([
            'trading_group_id' => $data['trading_group_id'] ?? $tradingAccount->trading_group_id,
            'name'    => $data['name'] ?? $tradingAccount->name,
            'country' => $data['country'] ??  $tradingAccount->country,
            'phone'   => $data['phone'] ??  $tradingAccount->phone,
            'email'   => $data['email'] ??  $tradingAccount->email,
            'leverage' => $data['leverage'] ??  $tradingAccount->leverage,
            'balance' => $data['balance'] ??  $tradingAccount->balance,
            'credit'  => $data['credit'] ??  $tradingAccount->credit,
            'equity'  => $data['equity'] ??  $tradingAccount->equity,
            'profit'  => $data['profit'] ??  $tradingAccount->profit,
            'swap'    => $data['swap'] ??  $tradingAccount->swap,
            'currency' => $data['currency'] ??  $tradingAccount->currency,
            'margin_level_percentage' => $data['margin_level_percentage'] ??  $tradingAccount->margin_level_percentage,
            'trading_account_group_id' => $data['trading_account_group_id ']??  $tradingAccount->trading_account_group_id,
            'brand_id' => $data['brand_id'] ??  $tradingAccount->brand_id,
            'status'   => $data['status'] ?? $account->status
        ]);
        return $tradingAccount;
    }

    public function deleteTradingAccount($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
