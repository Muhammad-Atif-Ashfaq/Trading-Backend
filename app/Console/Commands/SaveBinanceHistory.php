<?php

namespace App\Console\Commands;

use App\Models\Chart;
use App\Models\SymbelSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
        $symbols = SymbelSetting::where('feed_name', 'fcsapi')
            ->select('feed_fetch_name', 'feed_fetch_key')
            ->get();

        foreach ($symbols as $symbol) {
            $url = "https://fcsapi.com/api-v3/{$symbol->feed_fetch_key}/latest?id={$symbol->feed_fetch_name}&access_key=nlHesxOiUsI4KyCUulyq";

            // Initialize cURL session
            $curl = curl_init();

            // Set cURL options
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                ],
            ]);

            // Execute cURL request
            $response = curl_exec($curl);

            // Check for cURL errors
            if (curl_errno($curl)) {
                $this->error('cURL error: ' . curl_error($curl));
                continue; // Skip to the next symbol
            }

            // Close cURL session
            curl_close($curl);
            Log::info('Response for symbol1 ' . $symbol->feed_fetch_name . ': ' . json_encode($response));
            // Parse the response and save historical data to the database
            $data = json_decode($response, true);

            // Log the response for debugging purposes
            Log::info('Response for symbol2 ' . $symbol->feed_fetch_name . ': ' . json_encode($data));

            if (isset($data['response'][0])) {
                $item = $data['response'][0];
                Chart::create([
                    'name' => $item['s'], // Using 's' for symbol
                    'time' => $item['tm'], // Using 'tm' for time
                    'open' => $item['o'],  // Using 'o' for open
                    'high' => $item['h'],  // Using 'h' for high
                    'low' => $item['l'],   // Using 'l' for low
                    'close' => $item['c'], // Using 'c' for close
                ]);
            } else {
                $this->error("Invalid data structure received for symbol: {$symbol->feed_fetch_name}");
            }
        }
    }


}
