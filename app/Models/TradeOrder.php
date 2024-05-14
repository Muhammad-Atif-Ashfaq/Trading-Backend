<?php

namespace App\Models;

use App\Enums\TradeOrderTypeEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Traits\Models\HasGroupUniqueId;
use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\HasTradeOrder;
use Illuminate\Support\Facades\Http;

class TradeOrder extends Model
{
    use HasFactory,
        HasTradeOrder,
        HasGroupUniqueId,
        HasSearch;

    public static $PREFIX = '0xXX' . 'new_order';

    protected $fillable = [
        'order_type',
        'symbol',
        'feed_name',
        'trading_account_id',
        'brand_id',
        'trading_group_id',
        'group_unique_id',
        'type',
        'volume',
        'stopLoss',
        'takeProfit',
        'open_time',
        'open_price',
        'close_time',
        'close_price',
        'reason',
        'swap',
        'profit',
        'comment',
        'stop_limit_price'
    ];

    protected $with = ['symbolSetting'];

    public function symbolSetting()
    {
        return $this->belongsTo(SymbelSetting::class, 'symbol', 'feed_fetch_name');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'brand_id', 'id');
    }

    public function tradingAccount()
    {
        return $this->belongsTo(TradingAccount::class);
    }

    public function calculateProfitLoss($currentPrice, $entryPrice)
    {
        $symbolSetting = $this->symbolSetting; // Access the related symbolSetting model

        // Ensure symbolSetting exists and has the 'pip' property
        if ($symbolSetting && isset($symbolSetting->pip)) {
            $pip = $symbolSetting->pip;
        } else {
            $pip = 5;
        }
        if(!empty($currentPrice)){
            // Calculate profit/loss based on direction of the trade
            if ($this->type == 'buy') {
                $profit = ((double)$currentPrice - (double)$entryPrice);
            } else {
                $profit = ((double)$entryPrice - (double)$currentPrice);
            }

            // Calculate total profit/loss
            $totalProfit = ((double)number_format($profit, $pip) * $this->addZeroAfterOne($pip)) * $this->volume;

            return $totalProfit;
        }
        return 0;

    }

    function addZeroAfterOne($num)
    {
        $resultStr = '1';
        for ($i = 0; $i < $num; $i++) {
            $resultStr .= '0';
        }
        return intval($resultStr);
    }


    // Method to get current price (replace this with your actual implementation)
    public function getCurrentPrice($symbol_setting)
    {
        $data_feed = DataFeed::where('module', $symbol_setting->feed_name)->first();
        $current_price = null;

        switch ($data_feed->module) {
            case 'binance':
                // Logic to fetch current price from Binance data feed
                $current_price = $this->getCurrentPriceFromBinance($data_feed, $symbol_setting);
                break;
            case 'fcsapi':
                // Logic to fetch current price from FCSAPI data feed
                $current_price = $this->getCurrentPriceFromFcsapi($data_feed, $symbol_setting);
                break;
            case 'tradermade':
                // Logic to fetch current price from Tradermade data feed
                $current_price = $this->getCurrentPriceFromTradermade($data_feed);
                break;
            case 'twelvedata':
                // Logic to fetch current price from Twelvedata data feed
                $current_price = $this->getCurrentPriceFromTwelvedata($data_feed);
                break;
            case 'finnhub':
                // Logic to fetch current price from Finnhub data feed
                $current_price = $this->getCurrentPriceFromFinnhub($data_feed);
                break;
            case 'finage':
                // Logic to fetch current price from Finage data feed
                $current_price = $this->getCurrentPriceFromFinage($data_feed);
                break;
            default:
                // Handle unsupported data feed module
                break;
        }

        return $current_price;
    }

    // Implement methods to fetch current price for each data feed provider


    private function getCurrentPriceFromBinance($data_feed, $symbol_setting)
    {
        // Binance API endpoint for getting current price
        $url = $data_feed->feed_server . '/ticker/24hr?symbol=' . $symbol_setting->feed_fetch_name;

        // Fetch data from Binance API
        $response = Http::get($url);

        // Check if request was successful
        if ($response->successful()) {
            $ticker = $response->json();

            // Extract current price from the response
            if ($this->type == TradeOrderTypeEnum::BUY) {
                return $ticker['bidPrice'];
            } else {
                // Handle invalid response
                return $ticker['askPrice'];
            }
        } else {
            // Handle request failure
            return null;
        }
    }

    private function getCurrentPriceFromFcsapi($data_feed, $symbol_setting)
    {
        // FCSAPI API endpoint for getting current price
        $url = $data_feed->feed_server . '/' . $symbol_setting->feed_fetch_key . '/latest?id=' . $symbol_setting->feed_fetch_name.'&access_key='.$data_feed->feed_login;

        // Fetch data from FCSAPI
        $response = Http::get($url);

        // Check if request was successful
        if ($response->successful()) {
            $data = $response->json();

            // Extract current price from the response
            if (isset($data['response']['data'][$data_feed->symbol]['price'])) {
                return $data['response']['data'][$data_feed->symbol]['price'];
            } else {
                // Handle invalid response
                return null;
            }
        } else {
            // Handle request failure
            return null;
        }
    }


    private function getCurrentPriceFromTradermade($data_feed)
    {
        return null;
    }

    private function getCurrentPriceFromTwelvedata($data_feed)
    {
        return null;
    }

    private function getCurrentPriceFromFinnhub($data_feed)
    {
        return null;
    }

    private function getCurrentPriceFromFinage($data_feed)
    {
        return null;
    }


}
