<?php

namespace App\Console\Commands;

use App\Enums\OrderTypeEnum;
use App\Enums\TradingAccountStatusEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Models\TradeOrder;
use App\Models\TradingAccount;
use Illuminate\Console\Command;

class CheckMarginLevels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'margin:check';

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
        $accounts = TradingAccount::all();
        foreach ($accounts as $account) {
            if ($account->margin_level_percentage < $account->brand->margin_call) {
                $this->closePositions($account);
                $account->status = TradingAccountStatusEnum::MARGIN_CALL;
                $account->save();
                pushLiveDate('trading_accounts','update',$account);
            }
        }
    }

    protected function closePositions($account)
    {
        $unprofitableorder = TradeOrder::where('trading_account_id', $account->id)
            ->orderBy('profit', 'desc') // Order by profit in descending order
            ->first();

        if ($unprofitableorder) {
            $unprofitableorder->order_type = OrderTypeEnum::CLOSE;
            $unprofitableorder->save();

            pushLiveDate('trade_orders','update',$unprofitableorder);
            $this->info("Closing positions for account: {$account->id}\n");
        } else {
            $this->info("No unprofitable positions found for account: {$account->id}\n");
        }
    }
}
