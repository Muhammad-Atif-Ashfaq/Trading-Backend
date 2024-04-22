<?php

namespace App\Http\Controllers\Api\Config;

use App\Http\Controllers\Controller;
use App\Repositories\Api\Config\ConfigRepository;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHandlerHelper;



class ConfigController extends Controller
{
    protected $configRepository;

    public function __construct(ConfigRepository $ConfigRepository)
    {
        $this->configRepository = $ConfigRepository;
    }

    // TODO: Retrieves all config dataFeeds.
    public function getConfigDataFeeds()
    {
        return ExceptionHandlerHelper::tryCatch(function ()  {
            $configDataFeeds = $this->configRepository->getConfigDataFeeds();
            return $this->sendResponse($configDataFeeds, 'All Config DataFeeds');
        });
    }

}
