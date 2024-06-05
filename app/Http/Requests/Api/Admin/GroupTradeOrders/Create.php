<?php

namespace App\Http\Requests\Api\Admin\GroupTradeOrders;

use App\Enums\OrderTypeEnum;
use App\Enums\TradeOrderTypeEnum;
use App\Models\TradingAccount;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class Create extends FormRequest
{
    use ResponseTrait;

    // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'order_type' => ['required', 'in:' . implode(',', OrderTypeEnum::getOrderTypes())],
            'symbol' => 'required|exists:symbel_settings,name',
            'feed_name' => 'string|exists:data_feeds,module',
            'trading_group_id' => 'required|exists:trading_groups,id',
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
            'profit' => 'nullable|string',
            'comment' => 'nullable|string',
            'skip' => 'nullable|boolean'
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $data = $validator->validated();
                $skipAccounts = $data['skip'] ?? false;

                // Get accounts with low balance
                $lowBalanceAccounts = TradingAccount::where('trading_group_id', $data['trading_group_id'])
                    ->where('balance', '<=', 0)
                    ->pluck('login_id')
                    ->toArray();

                // Get accounts with low margin level percentage
                $lowMarginAccounts = TradingAccount::where('trading_group_id', $data['trading_group_id'])
                    ->whereHas('brand', function ($q) {
                        $q->whereColumn('stop_out', '>', 'margin_level_percentage');
                    })
                    ->pluck('login_id')
                    ->toArray();

                // Check if there are any accounts with low balance or low margin level percentage
                if (count($lowBalanceAccounts) || count($lowMarginAccounts)) {
                    if (!$skipAccounts) {
                        $errorMessage = '';

                        if (count($lowBalanceAccounts)) {
                            $errorMessage .= '<strong>Low Balance Accounts:</strong> ' . implode(', ', $lowBalanceAccounts) . '<br>';
                        }

                        if (count($lowMarginAccounts)) {
                            $errorMessage .= '<strong>Low Margin Level Percentage Accounts:</strong> ' . implode(', ', $lowMarginAccounts) . '<br>';
                        }

                        $validator->errors()->add('balance', $errorMessage);
                    }
                }
            }
        ];
    }
}
