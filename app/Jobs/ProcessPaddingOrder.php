<?php

namespace App\Jobs;

use App\Enums\OrderTypeEnum;
use App\Enums\TradeOrderTypeEnum;
use App\Models\SymbelSetting;
use App\Models\TradeOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class ProcessPaddingOrder implements ShouldQueue
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
        if(
            $this->order->type == TradeOrderTypeEnum::SELL_STOP_LIMIT
            ||
            $this->order->type == TradeOrderTypeEnum::BUY_SELL_LIMIT
        ){
            if($this->order->is_tech_price == 1){
                if ($currentPrice == $this->order->stop_limit_price){
                    $this->order->order_type = OrderTypeEnum::MARKET;
                    $this->order->save();

                    pushLiveDate('trade_orders','update',$this->order);
                }
            }elseif($currentPrice == $this->order->open_price){
                $this->order->is_tech_price = 1;
                $this->order->save();
            }
        }else{
            if ($currentPrice == $this->order->open_price){
                $this->order->order_type = OrderTypeEnum::MARKET;
                $this->order->save();

                pushLiveDate('trade_orders','update',$this->order);
            }
        }
    }
}
