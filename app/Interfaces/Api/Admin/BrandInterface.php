<?php

namespace App\Interfaces\Api\Admin;

interface BrandInterface
{
    /**
     * TODO: Get all brands.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllBrands($request);

    /**
     * TODO: Get all brands list.
     *
     * @return mixed
     */
    public function getAllBrandList();

    /**
     * TODO: Create a new brand.
     *
     * @param  array  $data
     * @return mixed
     */
    public function createBrand(array $data);

    /**
     * TODO: Find a brand by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findBrandById($id);

    /**
     * TODO: Update a brand with the given ID.
     *
     * @param  array  $data
     * @param  int  $id
     * @return mixed
     */
    public function updateBrand(array $data, $id);

    /**
     * TODO: Delete a brand by its ID.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteBrand($id);
}
