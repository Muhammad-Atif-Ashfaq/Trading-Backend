<?php

namespace App\Interfaces\Api\Admin;

interface TradingAccountInterface
{
    /**
     * TODO: Get all trading accounts.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllTradingAccounts($request);

    /**
     * TODO: Get all trading accounts list.
     *
     * @return mixed
     */
    public function getAllTradingAccountList();

    /**
     * TODO: Get all trading accounts not in any group.
     *
     * @return mixed
     */
    public function getAllTradingAccountsNotInGroup();

    /**
     * TODO: Create a trading account.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createTradingAccount(array $data);

    /**
     * TODO: Find a trading account by ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findTradingAccountById($id);

    /**
     * TODO: Update a trading account.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateTradingAccount(array $data, $id);

    /**
     * TODO: Delete a trading account by ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteTradingAccount($id);
}
