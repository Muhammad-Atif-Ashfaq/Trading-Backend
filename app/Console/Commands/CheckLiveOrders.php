<?php

namespace App\Console\Commands;

use App\Enums\OrderTypeEnum;
use App\Enums\TradeOrderTypeEnum;
use App\Jobs\ProcessLiveOrder;
use App\Models\TradeOrder;
use Illuminate\Console\Command;

class CheckLiveOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-live-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = TradeOrder::where('order_type', OrderTypeEnum::MARKET)
            ->whereNotNull('stopLoss')
            ->whereNotNull('takeProfit')
            ->get();

        foreach ($orders as $order) {
            ProcessLiveOrder::dispatch($order);
        }

        $this->info('Checked and dispatched  live orders.');
    }
}
