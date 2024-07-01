<?php

namespace App\Http\Requests\Api\Brand\TransactionOrders;

use App\Enums\OrderTypeEnum;
use App\Enums\TradeOrderTypeEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'trading_account_id' => 'nullable|exists:trading_accounts,id',
            'per_page' => 'nullable',
            'page' => 'nullable',
            'brand_id' => 'nullable|exists:brands,public_key',
        ];
    }
}
