<?php

namespace App\Repositories\Api\Config;


use App\Interfaces\Api\Config\ConfigInterface;

class ConfigRepository implements ConfigInterface
{
    private $config;

    public function __construct()
    {
        $this->config = config();
    }

    // TODO: Retrieves all config data feeds.
    public function getConfigDataFeeds()
    {
        $configDataFeeds = $this->config['DataFeeds'];
        return $configDataFeeds;
    }

}
