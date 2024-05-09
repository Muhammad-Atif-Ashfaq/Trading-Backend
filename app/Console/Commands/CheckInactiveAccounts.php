<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TradingAccount;
use Carbon\Carbon;

class CheckInactiveAccounts extends Command
{
    protected $signature = 'accounts:check_inactive';

    protected $description = 'Check for inactive trading accounts and update their status';

    public function handle()
    {
        // Get trading accounts that have been inactive for a certain period
        $inactiveAccounts = TradingAccount::where('last_access_time', '<', Carbon::now()->subMinutes(1))
            ->get();

        // Update their status to offline
        foreach ($inactiveAccounts as $account) {
            $account->update(['status' => 'active']);
            pushLiveDate('trading_accounts','update',$this->model->findOrFail($account->id));
        }

        $this->info('Inactive trading accounts checked and updated successfully.');
    }
}
