<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\DashboardRepository;
use App\Http\Requests\Api\Admin\Dashboard\tradingOrderNumbers;

class DashboardController extends Controller
{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }
    
    public function tradingOrderNumbers(tradingOrderNumbers $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $orders = $this->dashboardRepository->tradingOrderNumbers($request);
            return $this->sendResponse($orders, 'Filtered Orders');
        });
    }
}
