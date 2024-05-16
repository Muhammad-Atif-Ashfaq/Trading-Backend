<?php

namespace App\Console\Commands;

use App\Enums\OrderTypeEnum;
use App\Jobs\ProcessLiveOrder;
use App\Jobs\ProcessPaddingOrder;
use App\Models\TradeOrder;
use Illuminate\Console\Command;

class CheckPaddingOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-padding-orders';

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
        $orders = TradeOrder::where('order_type', OrderTypeEnum::PENDING)->get();

        foreach ($orders as $order) {
            ProcessPaddingOrder::dispatch($order);
        }

        $this->info('Checked and dispatched  pending orders.');
    }
}
