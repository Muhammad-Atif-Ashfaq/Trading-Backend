<?php

namespace App\Interfaces\Api\Admin;

interface SymbelGroupInterface
{
    /**
     * TODO: Get all symbol groups.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllSymbelGroups($request);

    /**
     * TODO: Create a new symbol group.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createSymbelGroup(array $data);

    /**
     * TODO: Find a symbol group by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findSymbelGroupById($id);

    /**
     * TODO: Update a symbol group with the given ID.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateSymbelGroup(array $data, $id);

    /**
     * TODO: Delete a symbol group by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteSymbelGroup($id);
}
