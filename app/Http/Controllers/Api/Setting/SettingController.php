<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\GetSetting;
use App\Http\Requests\Api\Setting\SetSetting;
use App\Repositories\Api\Setting\SettingRepository;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHandlerHelper;



class SettingController extends Controller
{
    protected $settingRepository;

    public function __construct(SettingRepository $SettingRepository)
    {
        $this->settingRepository = $SettingRepository;
    }

    // TODO: Retrieves all Settings.
    public function getSettings(GetSetting $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request)  {
            $settings = $this->settingRepository->getSettings($request->validated());
            return $this->sendResponse($settings, 'All Settings');
        });
    }

    // TODO: Store Settings.
    public function setSettings(SetSetting $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $settings = $this->settingRepository->setSettings($request->validated());
            return $this->sendResponse($settings, 'Settings updated Successfully');
        });
    }

}
