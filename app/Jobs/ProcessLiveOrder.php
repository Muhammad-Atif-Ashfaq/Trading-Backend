<?php

namespace App\Jobs;

use App\Enums\OrderTypeEnum;
use App\Models\SymbelSetting;
use App\Models\TradeOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessLiveOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(TradeOrder $order)
    {
        $this->order = $order;
    }

    public function handle(): void
    {
        $symbol_setting = SymbelSetting::where('feed_fetch_name',$this->order->symbol)->first();
        $currentPrice = $this->order->getCurrentPrice($symbol_setting);
        $profit = $this->order->calculateProfitLoss($currentPrice,$this->order->open_price);
        $this->order->profit = $profit;
        $this->order->order_type = OrderTypeEnum::CLOSE;
        if ($this->order->type === 'buy') {
            // Check if the current market price is at or below the stop loss
            if ($currentPrice <= $this->order->stopLoss) {
                $this->closeOrder($currentPrice, 'Stop Loss');
            }

            // Check if the current market price is at or above the take profit
            if ($currentPrice >= $this->order->takeProfit) {
                $this->closeOrder($currentPrice, 'Take Profit');
            }
        } elseif ($this->order->type === 'sell') {
            // Check if the current market price is at or above the stop loss
            if ($currentPrice >= $this->order->stopLoss) {
                $this->closeOrder($currentPrice, 'Stop Loss');
            }

            // Check if the current market price is at or below the take profit
            if ($currentPrice <= $this->order->takeProfit) {
                $this->closeOrder($currentPrice, 'Take Profit');
            }
        }
    }

    protected function closeOrder(float $price, string $reason): void
    {
        $profit = $this->order->calculateProfitLoss($price, $this->order->open_price);
        $this->order->profit = $profit;
        $this->order->order_type = OrderTypeEnum::CLOSE;
        $this->order->close_price = $price;
        $this->order->close_time = now();
        $this->order->reason = $reason;
        $this->order->save();

        pushLiveDate('trade_orders','update',$this->order);
    }
}