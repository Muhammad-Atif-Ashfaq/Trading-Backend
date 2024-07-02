<?php

namespace App\Repositories\Api\Brand;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Brand\BrandLoginActivityInterface;
use App\Models\UserLoginActivity;
use Str;

class BrandLoginActivityRepository implements BrandLoginActivityInterface
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

}