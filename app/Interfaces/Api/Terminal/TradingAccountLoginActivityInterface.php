<?php

namespace App\Interfaces\Api\Terminal;

interface TradingAccountLoginActivityInterface
{
    /**
     * TODO: Get all TradingAccountLoginActivities.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllTradingAccountLoginActivitys($request);

    /**
     * TODO: Get all TradingAccountLoginActivities list.
     *
     * @return mixed
     */
    public function getAllTradingAccountLoginActivityList();

    /**
     * TODO: Create a new TradingAccountLoginActivity.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createTradingAccountLoginActivity(array $data);

    /**
     * TODO: Find a TradingAccountLoginActivity by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findTradingAccountLoginActivityById($id);

    /**
     * TODO: Update a TradingAccountLoginActivity with the given ID.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateTradingAccountLoginActivity(array $data, $id);

    /**
     * TODO: Delete a TradingAccountLoginActivity by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteTradingAccountLoginActivity($id);
}
