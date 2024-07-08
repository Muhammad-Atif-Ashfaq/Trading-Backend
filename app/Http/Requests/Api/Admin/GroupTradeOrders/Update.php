<?php

namespace App\Http\Requests\Api\Admin\GroupTradeOrders;

use App\Enums\OrderTypeEnum;
use App\Enums\TradeOrderTypeEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    use ResponseTrait;

    // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'order_type' => ['nullable', 'in:'.implode(',', OrderTypeEnum::getOrderTypes())],
            'symbol' => 'nullable|exists:symbel_settings,feed_fetch_name',
            'feed_name' => 'string|exists:data_feeds,module',
            'trading_group_id' => 'nullable|exists:trading_groups,id',
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
            'profit' => 'nullable|string',
            'comment' => 'nullable|string',
            'skip' => 'nullable|boolean',
        ];
    }
}
