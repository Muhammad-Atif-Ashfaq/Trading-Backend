<?php

namespace App\Http\Requests\Api\Terminal\Order;

use App\Enums\OrderTypeEnum;
use App\Enums\TradeOrderTypeEnum;
use App\Rules\BrandBelongsToTradingAccount;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'order_type' => ['nullable', 'in:'.implode(',', OrderTypeEnum::getOrderTypes())],
            'symbol' => 'nullable|exists:symbel_settings,feed_fetch_name',
            'feed_name' => 'string|exists:data_feeds,module',
            'trading_account_id' => 'nullable|exists:trading_accounts,id',
            'brand_id' => [
                'nullable',
                'exists:brands,public_key',
                new BrandBelongsToTradingAccount($this->input('trading_account_id'), 'id'),
            ],
            'type' => 'nullable|in:'.implode(',', TradeOrderTypeEnum::getTypes()),
            'volume' => 'nullable|string',
            'stopLoss' => 'nullable|string',
            'takeProfit' => 'nullable|string',
            'open_time' => 'nullable|string',
            'open_price' => 'nullable|string',
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
}
