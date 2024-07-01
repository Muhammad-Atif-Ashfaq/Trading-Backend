<?php

namespace App\Http\Requests\Api\Brand\TradeOrders;

use App\Enums\OrderTypeEnum;
use App\Enums\TradeOrderTypeEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait;

    // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'order_type' => ['required', 'in:' . implode(',', OrderTypeEnum::getOrderTypes())],
            'symbol' => 'required|exists:symbel_settings,feed_fetch_name',
            'feed_name' => 'string|exists:data_feeds,module',
            'trading_account_id' => 'required|exists:trading_accounts,id',
            'brand_id' => 'required|exists:brands,public_key',
            'type' => 'required|in:' . implode(',', TradeOrderTypeEnum::getTypes()),
            'volume' => 'required|string',
            'stopLoss' => 'nullable|string',
            'takeProfit' => 'nullable|string',
            'open_time' => 'required|string',
            'open_price' => 'required|string',
            'close_time' => 'nullable|string',
            'close_price' => 'nullable|string',
            'reason' => 'nullable|string',
            'swap' => 'nullable|string',
            'commission' => 'nullable|string',
            'profit' => 'nullable|string',
            'comment' => 'nullable|string',
            'stop_limit_price' => 'nullable|string',
        ];
    }

//    protected function withValidator($validator)
//    {
//        $validator->after(function ($validator) {
//            $trading_account_id = $this->input('trading_account_id');
//            $symbol = $this->input('symbol');
//            $lotSize = $this->input('volume');
//
//            $trading_account = TradingAccount::find($trading_account_id);
//            $symbol_setting = SymbelSetting::where('feed_fetch_name',$symbol)->first();
//            $symbol_group = $symbol_setting->group();
//
//
//            $commission = $symbol_setting->commission;
//
//            $balance = $trading_account->balance;
//            $leverage = $trading_account->leverage;
//            $openOrdersVolume = $trading_account->getOpenOrdersVolume();
//
//            $maxPositionSize = ($balance * $leverage) / $lotSize;
//
//            if ($balance < $commission) {
//                $validator->errors()->add('commission', 'Insufficient balance for commission');
//            }
//
//            if ($lotSize > $maxPositionSize) {
//                $validator->errors()->add('lot_size', 'Position size exceeds maximum allowable size');
//            }
//
//            if (($openOrdersVolume + $lotSize) > $maxPositionSize) {
//                $validator->errors()->add('lot_size', 'Total open orders volume exceeds maximum allowable size');
//            }
//
//            // Calculate used margin
//            $usedMargin = $lotSize / $leverage; // Assuming a simple calculation for used margin
//            // Calculate equity
//            $equity = $balance + $trading_account->getOpenPositionsProfit($symbol_setting); // Assuming you have a method to get open positions profit
//            // Calculate free margin
//            $freeMargin = $equity - $usedMargin;
//            // Calculate margin level
//            $marginLevel = ($equity / $usedMargin) * 100;
//
//        });
//
//    } protected function withValidator($validator)
//    {
//        $validator->after(function ($validator) {
//            $trading_account_id = $this->input('trading_account_id');
//            $symbol = $this->input('symbol');
//            $lotSize = $this->input('volume');
//
//            $trading_account = TradingAccount::find($trading_account_id);
//            $symbol_setting = SymbelSetting::where('feed_fetch_name',$symbol)->first();
//            $symbol_group = $symbol_setting->group();
//
//
//            $commission = $symbol_setting->commission;
//
//            $balance = $trading_account->balance;
//            $leverage = $trading_account->leverage;
//            $openOrdersVolume = $trading_account->getOpenOrdersVolume();
//
//            $maxPositionSize = ($balance * $leverage) / $lotSize;
//
//            if ($balance < $commission) {
//                $validator->errors()->add('commission', 'Insufficient balance for commission');
//            }
//
//            if ($lotSize > $maxPositionSize) {
//                $validator->errors()->add('lot_size', 'Position size exceeds maximum allowable size');
//            }
//
//            if (($openOrdersVolume + $lotSize) > $maxPositionSize) {
//                $validator->errors()->add('lot_size', 'Total open orders volume exceeds maximum allowable size');
//            }
//
//            // Calculate used margin
//            $usedMargin = $lotSize / $leverage; // Assuming a simple calculation for used margin
//            // Calculate equity
//            $equity = $balance + $trading_account->getOpenPositionsProfit($symbol_setting); // Assuming you have a method to get open positions profit
//            // Calculate free margin
//            $freeMargin = $equity - $usedMargin;
//            // Calculate margin level
//            $marginLevel = ($equity / $usedMargin) * 100;
//
//        });
//
//    }


}
