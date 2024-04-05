<?php

namespace App\Interfaces\Api\Admin;

interface TradingGroupInterface
{
    /**
     * TODO: Get all trading groups.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllTradingGroups($request);

    /**
     * TODO: Create a trading group.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createTradingGroup(array $data);

    /**
     * TODO: Find a trading group by ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findTradingGroupById($id);

    /**
     * TODO: Update a trading group.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateTradingGroup(array $data, $id);

    /**
     * TODO: Delete a trading group by ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteTradingGroup($id);
}
