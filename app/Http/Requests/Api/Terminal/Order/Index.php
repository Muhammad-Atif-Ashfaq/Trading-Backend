<?php

namespace App\Http\Requests\Api\Terminal\Order;

use App\Enums\OrderTypeEnum;
use App\Enums\TradeOrderTypeEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'order_type' => ['nullable', 'in:' . implode(',', OrderTypeEnum::getOrderTypes())],
            'per_page' => 'nullable',
            'page' => 'nullable',
        ];
    }
}
