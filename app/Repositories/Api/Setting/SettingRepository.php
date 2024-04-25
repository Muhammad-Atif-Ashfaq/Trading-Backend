<?php

namespace App\Repositories\Api\Setting;


use App\Helpers\SettingHelper;
use App\Interfaces\Api\Setting\SettingInterface;
use App\Models\Setting;

class SettingRepository implements SettingInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new Setting();
    }


    // TODO: Retrieves all Settings.
    public function getSettings(array $data)
    {
        return SettingHelper::getSettings($data['names']);
    }

    // TODO: Store Settings.
    public function setSettings(array $data)
    {
        foreach ($data as $data){
            SettingHelper::setSetting($data['name'],$data['value']);
        }
    }
}
