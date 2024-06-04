<?php

namespace App\Interfaces\Api\Admin;

interface FireWallInterface
{
    /**
     * TODO: Get all IpLists.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllIpLists($request);


    /**
     * TODO: addToIpList.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function addToIpList($request);
}
