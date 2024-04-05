<?php

namespace App\Interfaces\Api\Admin;

interface SymbelSettingInterface
{
    /**
     * TODO: Get all symbol settings.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllSymbelSettings($request);

    /**
     * TODO: Create a new symbol setting.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createSymbelSetting(array $data);

    /**
     * TODO: Find a symbol setting by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findSymbelSettingById($id);

    /**
     * TODO: Update a symbol setting with the given ID.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateSymbelSetting(array $data, $id);

    /**
     * TODO: Delete a symbol setting by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteSymbelSetting($id);
}
