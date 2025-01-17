<?php

namespace App\Http\Controllers\Api\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Brand\DashboardRepository;
use App\Http\Requests\Api\Brand\Dashboard\GetDashboardData;

class DashboardController extends Controller
{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getDashboardData(GetDashboardData $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $orders = $this->dashboardRepository->getDashboardData($request);
            return $this->sendResponse($orders, 'Filtered Orders');
        });
    }
}
