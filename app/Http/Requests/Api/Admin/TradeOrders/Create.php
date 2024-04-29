<?php

namespace App\Http\Requests\Api\Admin\TradeOrders;

use App\Enums\OrderTypeEnum;
use App\Enums\TradeOrderTypeEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'order_type' => ['required', 'in:' . implode(',', OrderTypeEnum::getOrderTypes())],
            'symbol' => 'required|exists:symbel_settings,feed_fetch_name',
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
            'profit' => 'nullable|string',
            'comment' => 'nullable|string',
            'stop_limit_price' => 'nullable|string',
        ];
    }
}
