<?php

namespace App\Interfaces\Api\Brand;
use App\Models\TradeOrder;

interface GroupTradeOrderInterface
{
    /**
     * TODO: Get all group trade orders.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllGroupTradeOrders($request);

    /**
     * TODO: Create a new group trade order.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createGroupTradeOrder(array $data);

    /**
     * TODO: Find a group trade order by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findGroupTradeOrderById(TradeOrder $tradeOrder);

    /**
     * TODO: Update a group trade order with the given ID.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateGroupTradeOrder(array $data, TradeOrder $tradeOrder);

    /**
     * TODO: Delete a group trade order by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteGroupTradeOrder(TradeOrder $tradeOrder);
}