<?php

namespace App\Http\Controllers\Api\Config;

use App\Http\Controllers\Controller;
use App\Repositories\Api\Config\ConfigRepository;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHandlerHelper;
use App\Http\Requests\Api\Config\BrandConfigRequest;



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

    public function getBrandConfig(BrandConfigRequest $request)
    {
        return ExceptionHandlerHelper::tryCatch(function ()  use($request){
            $configDataFeeds = $this->configRepository->getBrandConfig($request->brand_id);
            return $this->sendResponse($configDataFeeds, 'Brand Configurations');
        });
    }


}