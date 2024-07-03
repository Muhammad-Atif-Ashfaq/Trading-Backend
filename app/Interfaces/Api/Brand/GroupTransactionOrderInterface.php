<?php

namespace App\Interfaces\Api\Brand;
use App\Models\TransactionOrder;
interface GroupTransactionOrderInterface
{
    /**
     * TODO: Get all  Transaction orders.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllGroupTransactionOrder($request);

    /**
     * TODO: Create a new  Transaction order.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createGroupTransactionOrder(array $data);

    /**
     * TODO: Find a Transaction order by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findGroupTransactionOrderById(TransactionOrder $transactionOrder);

    /**
     * TODO: Update a Transaction order with the given ID.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateGroupTransactionOrder(array $data, TransactionOrder $transactionOrder);

    /**
     * TODO: Delete a Transaction order by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteGroupTransactionOrder(TransactionOrder $transactionOrder);
}