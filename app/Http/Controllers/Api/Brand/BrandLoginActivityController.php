<?php

namespace App\Http\Controllers\Api\Brand;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Http\Requests\Api\Brand\BrandLoginActivity\Index as BrandLoginActivityCreate;
use App\Repositories\Api\Brand\BrandLoginActivityRepository;
use Illuminate\Http\Request;


class BrandLoginActivityController extends Controller
{
    protected $brndLoginActivityRepository;

    public function __construct(BrandLoginActivityRepository $brandLoginActivityRepository)
    {
        $this->brandLoginActivityRepository = $brandLoginActivityRepository;
    }


    public function index(BrandLoginActivityCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $UserLoginActivitys = $this->brandLoginActivityRepository->getAllUserLoginActivitys($request);
            return $this->sendResponse($UserLoginActivitys, 'All Brand Login Activities');
        });
    }


}