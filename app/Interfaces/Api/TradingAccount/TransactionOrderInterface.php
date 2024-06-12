<?php

namespace App\Interfaces\Api\TradingAccount;

interface TransactionOrderInterface
{
    /**
     * TODO: Get all transaction orders.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllTransactionOrders($request);

    /**
     * TODO: Create a transaction order.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createTransactionOrder(array $data);

    /**
     * TODO: Find a transaction order by ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findTransactionOrderById($id);

    /**
     * TODO: Update a transaction order.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateTransactionOrder(array $data, $id);

    /**
     * TODO: Delete a transaction order by ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteTransactionOrder($id);
}
