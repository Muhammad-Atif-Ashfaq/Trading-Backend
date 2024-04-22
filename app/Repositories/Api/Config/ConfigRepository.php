<?php

namespace App\Repositories\Api\Config;


use App\Interfaces\Api\Config\ConfigInterface;

class ConfigRepository implements ConfigInterface
{
    public function getConfigDataFeeds()
    {
        $data = config('Datafeeds');
        return $data;
    }
}
