<?php
namespace App\Repositories\Api\Terminal;

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
}
