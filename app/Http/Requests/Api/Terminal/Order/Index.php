<?php

namespace App\Http\Requests\Api\Terminal\Order;

use App\Enums\OrderTypeEnum;
use App\Rules\BrandBelongsToTradingAccount;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'order_type' => ['nullable', 'array'],
            'order_type.*' => ['in:'.implode(',', OrderTypeEnum::getOrderTypes())],
            'trading_account_id' => 'required|exists:trading_accounts,id',
            'per_page' => 'nullable',
            'page' => 'nullable',
            'brand_id' => [
                'required',
                'exists:brands,public_key',
                new BrandBelongsToTradingAccount($this->input('trading_account_id'), 'id'),
            ],
        ];
    }
}
