<?php

namespace App\Interfaces\Api\Config;


interface ConfigInterface
{
    /**
     * TODO: Get all Config DataFeeds.
     *
     * @return mixed
     */
    public function getConfigDataFeeds();
    public function getBrandConfig($brand_id);

}