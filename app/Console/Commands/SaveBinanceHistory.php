<?php

namespace App\Console\Commands;

use App\Models\Chart;
use App\Models\SymbelSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SaveBinanceHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:save-binance-history';

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

        $symbols = SymbelSetting::where('feed_name', 'binance')
            ->pluck('feed_fetch_name')
            ->toArray();

        foreach ($symbols as $symbol) {
            // Make a request to the Binance API for historical data of the current symbol
            $response = Http::get('https://api.binance.com/api/v1/klines', [
                'symbol' => $symbol,
                'interval' => '1m', // 1-minute interval
                'limit' => 1, // Adjust limit as per your requirement
            ]);

            // Parse the response and save historical data to the database
            $data = $response->json();

            foreach ($data as $item) {
                Chart::create([
                    'symbol' => $symbol,
                    'time' => $item[0],
                    'open' => $item[1],
                    'high' => $item[2],
                    'low' => $item[3],
                    'close' => $item[4],
                    'volume' => $item[5],
                ]);
            }
        }

        $this->info('Historical data saved successfully for all symbols.');
    }
}
