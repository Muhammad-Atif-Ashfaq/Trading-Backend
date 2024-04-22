<?php

namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Models\TradeOrder;
use Carbon\Carbon;

class DashboardRepository 
{
    private $model;

    public function __construct()
    {
        $this->model = new TradeOrder();
    }

    public function tradingOrderNumbers($request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = $this->model::selectRaw('COUNT(*) as order_count, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->groupBy('month');

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $orders = $query->get();

        $chartData = $orders->map(function ($item) {
            return [
                'month' => Carbon::parse($item->month)->format('F Y'),
                'order_count' => $item->order_count
            ];
        });
        
        return $chartData;
    }
}