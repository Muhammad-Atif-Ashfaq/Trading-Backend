<?php

namespace App\Http\Requests\Api\Brand\TradeOrders;

use App\Enums\OrderTypeEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'order_type' => ['nullable', 'array'],
            'order_type.*' => ['in:' . implode(',', OrderTypeEnum::getOrderTypes())],
            'trading_account_id' => 'nullable|exists:trading_accounts,id',
            'per_page' => 'nullable',
            'page' => 'nullable',
            'brand_id' => 'nullable|exists:brands,public_key',
        ];
    }
}
