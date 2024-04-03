<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Api\Admin\TickAndChartRepository;
use App\Helpers\{ExceptionHandlerHelper, PaginationHelper};
use Illuminate\Http\Request;
use App\Models\Tick;

class TickAndChartController extends Controller
{

    protected $tickAndChartRepository;

    public function __construct(TickAndChartRepository $tickAndChartRepository)
    {
        $this->tickAndChartRepository = $tickAndChartRepository;
    }

    // TODO: Retrieves all ticks.
    public function ticks(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tickAndCharts = $this->tickAndChartRepository->getAllTicks($request);
            return $this->sendResponse($tickAndCharts, 'All Ticks');
        });
    }

    // TODO: Retrieves all charts.
    public function charts(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tickAndCharts = $this->tickAndChartRepository->getAllCharts($request);
            return $this->sendResponse($tickAndCharts, 'All Charts');
        });
    }



}
