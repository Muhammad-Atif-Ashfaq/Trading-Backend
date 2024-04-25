<?php

namespace App\Helpers;

use App\Models\Setting;


class SettingHelper extends Helper
{

    // TODO: Retrieves all Settings.
    public static function getSettings(array $names)
    {
        return Setting::whereIn('name', $names)->get();
    }

    // TODO: Store Setting.
    public static function setSetting($name, $value)
    {
        return Setting::create([
            'name' => $name,
            'value' => $value
        ]);
    }


}

