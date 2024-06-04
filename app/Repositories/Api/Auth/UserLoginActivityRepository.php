<?php

namespace App\Repositories\Api\Auth;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Auth\UserLoginActivityInterface;
use App\Models\UserLoginActivity;
use Str;

class UserLoginActivityRepository implements UserLoginActivityInterface
{
    private $model;


    public function __construct()
    {
        $this->model = new UserLoginActivity();

    }

    // TODO: Get all UserLoginActivity.
    public function getAllUserLoginActivitys($request)
    {

        $user_login_activities = $this->model->whereSearch($request);
        $user_login_activities = PaginationHelper::paginate(
            $user_login_activities,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $user_login_activities;
    }

    // TODO: Get all user login activities list.
    public function getAllUserLoginActivityList()
    {
        $user_login_activities = $this->model
            ->select('*')
            ->get();
        return $user_login_activities;
    }

    // TODO: Create a user login Activity.
    public function createUserLoginActivity(array $data)
    {

        $user_login_activity = $this->model->create([
            'user_id' => $data['user_id'],
            'ip_address' => $data['ip_address'],
            'mac_address' => $data['mac_address'],
            'login_time' => $data['login_time'],
            'logout_time' => $data['logout_time'],
        ]);


        return $user_login_activity;
    }

    // TODO: Find a UserLoginActivity by ID.
    public function findUserLoginActivityById($id)
    {
        return $this->model->findOrFail($id);
    }

    // TODO: Update a UserLoginActivity.
    public function updateUserLoginActivity(array $data, $id)
    {
        $user_login_activity = $this->model->findOrFail($id);
        $user_login_activity->update(prepareUpdateCols($data, 'user_login_activities'));
        return $user_login_activity;
    }

    // TODO: Delete a UserLoginActivity.
    public function deleteUserLoginActivity($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
