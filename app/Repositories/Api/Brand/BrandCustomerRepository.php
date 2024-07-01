<?php

namespace App\Repositories\Api\Brand;


use App\Helpers\SystemHelper;
use App\Interfaces\Api\Admin\BrandCustomerInterface;
use App\Models\User;
use Str;

class BrandCustomerRepository implements BrandCustomerInterface
{
    private $model;
    private $user;

    public function __construct()
    {
        $this->model = new User();

    }

    // TODO: Get all brands list.
    public function getAllBrandCustomerList($brand_id)
    {
        $brands = $this->model
            ->where('brand_id',$brand_id)
            ->select('name', 'id','currency','phone','email','country')

            ->get();
        return $brands;
    }
}
