<?php

namespace App\Repositories\Api\Terminal;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Terminal\TradingAccountLoginActivityInterface;
use App\Models\TradingAccountLoginActivity;

class TradingAccountLoginActivityRepository implements TradingAccountLoginActivityInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new TradingAccountLoginActivity();

    }

    // TODO: Get all TradingAccountLoginActivity.
    public function getAllTradingAccountLoginActivitys($request)
    {

        $trading_account_login_activities = $this->model->whereSearch($request);
        $trading_account_login_activities = PaginationHelper::paginate(
            $trading_account_login_activities,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );

        return $trading_account_login_activities;
    }

    // TODO: Get all TradingAccount login activities list.
    public function getAllTradingAccountLoginActivityList()
    {
        $trading_account_login_activities = $this->model
            ->select('*')
            ->get();

        return $trading_account_login_activities;
    }

    // TODO: Create a TradingAccount login Activity.
    public function createTradingAccountLoginActivity(array $data)
    {

        $trading_account_login_activity = $this->model->create([
            'trading_account_id' => $data['trading_account_id'],
            'ip_address' => $data['ip_address'],
            'mac_address' => $data['mac_address'] ?? '',
            'login_time' => $data['login_time'],
            'logout_time' => $data['logout_time'] ?? '',
        ]);

        pushLiveDate('trading_account_login_activities', 'create', prepareExportData($this->model, [$trading_account_login_activity])[0]);

        return $trading_account_login_activity;
    }

    // TODO: Find a TradingAccountLoginActivity by ID.
    public function findTradingAccountLoginActivityById($id)
    {
        return $this->model->findOrFail($id);
    }

    // TODO: Update a TradingAccountLoginActivity.
    public function updateTradingAccountLoginActivity(array $data, $id)
    {
        $trading_account_login_activity = $this->model->findOrFail($id);
        $trading_account_login_activity->update(prepareUpdateCols($data, 'TradingAccount_login_activities'));
        pushLiveDate('trading_account_login_activities', 'update', prepareExportData($this->model, [$this->model->findOrFail($id)])[0]);

        return $trading_account_login_activity;
    }

    // TODO: Delete a TradingAccountLoginActivity.
    public function deleteTradingAccountLoginActivity($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
