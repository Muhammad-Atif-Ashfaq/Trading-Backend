<?php

namespace App\Repositories\Api\Config;
use App\Models\Brand;


use App\Interfaces\Api\Config\ConfigInterface;

class ConfigRepository implements ConfigInterface
{
    private $model;
    public function __construct()
    {
        $this->model = new Brand();
    }
    public function getConfigDataFeeds()
    {

        $data = config('Datafeeds');
        return $data;
    }

    public function getBrandConfig($brand_id)
    {
        $data['configuration'] = config('brandConfig');
        $data['brand'] = $this->model
            ->where('public_key',$brand_id)
            ->first();
        return $data;
    }
}