<?php

namespace App\Interfaces\Api\Auth;

interface UserLoginActivityInterface
{
    /**
     * TODO: Get all UserLoginActivities.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllUserLoginActivitys($request);

    /**
     * TODO: Get all UserLoginActivities list.
     *
     * @return mixed
     */
    public function getAllUserLoginActivityList();

    /**
     * TODO: Create a new UserLoginActivity.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createUserLoginActivity(array $data);

    /**
     * TODO: Find a UserLoginActivity by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findUserLoginActivityById($id);

    /**
     * TODO: Update a UserLoginActivity with the given ID.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateUserLoginActivity(array $data, $id);

    /**
     * TODO: Delete a UserLoginActivity by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteUserLoginActivity($id);
}
