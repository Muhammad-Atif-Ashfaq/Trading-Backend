<?php

namespace App\Repositories\Api\Brand;

use App\Enums\TransactionOrderTypeEnum;
use App\Interfaces\Api\Brand\DashboardInterface;
use App\Models\TradeOrder;
use App\Models\TransactionOrder;
use Carbon\Carbon;

class DashboardRepository implements DashboardInterface
{
    private $model;

    public function __construct()
    {
        $this->trade_order = new TradeOrder();
        $this->transaction_order = new TransactionOrder();
    }

    public function getDashboardData($request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $types = $request->input('types');
        $data = [];

        // TODO :: Trading Order By Numbers
        if (in_array('trading_order_by_numbers', $types)){
            $query = $this->trade_order->selectRaw('COUNT(*) as order_count, DATE_FORMAT(created_at, "%Y-%m") as month')
                ->groupBy('month');

            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

            $orders = $query->get();

            $data['trading_order_by_numbers'] = $orders->map(function ($item) {
                return [
                    'month' => Carbon::parse($item->month)->format('F Y'),
                    'order_count' => $item->order_count
                ];
            });
        }

        // TODO :: Trading Volume By Lots
        if (in_array('trading_volume_by_lots', $types)){
            $query = $this->trade_order->selectRaw('volume,COUNT(*) as order_count, DATE_FORMAT(created_at, "%Y-%m") as month')
                ->groupBy('month')->groupBy('volume');

            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

            $orders = $query->get();

            $data['trading_volume_by_lots'] = $orders->map(function ($item) {
                return [
                    'month' => Carbon::parse($item->month)->format('F Y'),
                    'volume' => $item->volume,
                    'order_count' => $item->order_count
                ];
            });
        }

        // TODO :: Deposits
        if (in_array('deposits', $types)){
            $query = $this->transaction_order
                ->where('type', TransactionOrderTypeEnum::DEPOSIT)
                ->selectRaw('SUM(amount) as total_amount, DATE_FORMAT(created_at, "%Y-%m") as month')
                ->groupBy('month');

            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

            $orders = $query->get();

            $data['deposits'] = $orders->map(function ($item) {
                return [
                    'month' => Carbon::parse($item->month)->format('F Y'),
                    'total_amount' => $item->total_amount
                ];
            });
        }

        return $data;
    }
}
