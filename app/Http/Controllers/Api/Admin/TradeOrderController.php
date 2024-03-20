<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\{ExceptionHandlerHelper, PaginationHelper};
use App\Models\TradeOrder;

class TradeOrderController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new TradeOrder();
    }
    
    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $symbelSetting = $this->model::query();
            $order = PaginationHelper::paginate(
                $symbelSetting,
                $request->input('per_page', 10),
                $request->input('page', 1)
            );
            return $this->sendResponse($order, 'All Trade Orders');
        });
    }

    public function store(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $order = $this->model::create([
                'order_type' => $request->order_type,
                'symbol'     => $request->symbol,
                'trading_account_id' => $request->trading_account_id,
                'type'       => $request->type,
                'volume'     => $request->volume,
                'stopLoss'   => $request->stopLoss,
                'takeProfit' => $request->takeProfit,
                'price'      => $request->price,
                'open_time'  => $request->open_time,
                'open_price' => $request->open_price,
                'close_time' => $request->close_time,
                'close_price'=> $request->close_price,
                'reason'     => $request->reason,
                'swap'       => $request->swap,
                'profit'     => $request->profit,
                'comment'    => $request->comment
            ]);
            if($order)
            {
                return $this->sendResponse($order, 'Trade Orders Store Successfully');
            }
        });
    }

    
    public function show(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $order = $this->model::find($id);
            return $this->sendResponse($order, 'Single Trade Order');
        });
    }


    public function update(Request $request, string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $order = $this->model::find($id);
            $update = $order->update([
                'order_type' => $request->order_type ?? $order->order_type,
                'symbol'     => $request->symbol ?? $order->order_type,
                'trading_account_id' => $request->trading_account_id ?? $order->trading_account_id,
                'type'       => $request->type ?? $order->type,
                'volume'     => $request->volume ?? $order->volume,
                'stopLoss'   => $request->stopLoss ?? $order->stopLoss,
                'takeProfit' => $request->takeProfit ?? $order->takeProfit,
                'price'      => $request->price ?? $order->open_time,
                'open_time'  => $request->open_time ?? $order->price,
                'open_price' => $request->open_price ?? $order->open_price,
                'close_time' => $request->close_time ?? $order->close_time,
                'close_price'=> $request->close_price ?? $order->close_price,
                'reason'     => $request->reason ?? $order->reason,
                'swap'       => $request->swap ?? $order->swap,
                'profit'     => $request->profit ?? $order->profit,
                'comment'    => $request->comment ?? $order->comment
            ]);
            if ($update) {
                return $this->sendResponse($order, 'Trade Orders Update Successfully');
            }
        });
    }

    
    public function destroy(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $tradeOrder = $this->model::find($id)->delete();
            return $this->sendResponse($tradeOrder, 'Trade Order Deleted');
        });
    }
}