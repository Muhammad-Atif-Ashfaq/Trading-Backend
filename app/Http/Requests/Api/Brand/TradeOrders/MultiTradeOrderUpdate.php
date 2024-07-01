<?php

namespace App\Http\Requests\Api\Brand\TradeOrders;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class MultiTradeOrderUpdate extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'orders' => ['required', 'array'],
        ];
    }
}
