<?php

namespace App\Interfaces\Api\Admin;

interface TradeOrderInterface
{
    /**
     * TODO: Get all trade orders.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllTradeOrders($request);

    /**
     * TODO: Create a trade order.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createTradeOrder(array $data);

    /**
     * TODO: Find a trade order by ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findTradeOrderById($id);

    /**
     * TODO: Update a trade order.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateTradeOrder(array $data, $id);

    /**
     * TODO: Update a trade order.
     *
     * @param  array  $data
     * @return mixed
     */
    public function updateMultiTradeOrder(array $data);

    /**
     * TODO: Delete a trade order by ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteTradeOrder($id);
}
