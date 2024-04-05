<?php

namespace App\Interfaces\Api\Admin;

interface DataFeedInterface
{
    /**
     * TODO: Get all data feeds.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllDataFeeds($request);

    /**
     * TODO: Create a new data feed.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createDataFeed(array $data);

    /**
     * TODO: Find a data feed by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findDataFeedById($id);

    /**
     * TODO: Update a data feed with the given ID.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateDataFeed(array $data, $id);

    /**
     * TODO: Delete a data feed by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteDataFeed($id);
}
