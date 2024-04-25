<?php

namespace App\Interfaces\Api\Setting;

interface SettingInterface
{
    /**
     * Get settings based on provided data.
     *
     * @param array $data Data to filter or specify settings.
     * @return mixed Settings data.
     */
    public function getSettings(array $data);

    /**
     * Set settings based on provided data.
     *
     * @param array $data Data containing settings to be set.
     * @return mixed Confirmation of setting changes.
     */
    public function setSettings(array $data);
}
