<?php

namespace App\Interfaces\Api\Terminal;

interface OrderInterface
{
    /**
     * TODO: Get all orders.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllOrders($request);

    /**
     * TODO: Create an order.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createOrder(array $data);

    /**
     * TODO: Find an order by ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findOrderById($id);

    /**
     * TODO: Update an order.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateOrder(array $data, $id);

    /**
     * TODO: Update a trade order.
     *
     * @param  array  $data
     * @return mixed
     */
    public function updateMultiTradeOrder(array $data);

    /**
     * TODO: Delete an order by ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteOrder($id);
}
