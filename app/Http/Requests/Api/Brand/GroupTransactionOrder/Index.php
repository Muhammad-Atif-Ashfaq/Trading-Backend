<?php

namespace App\Http\Requests\Api\Brand\GroupTransactionOrder;

use App\Enums\TransactionOrderMethodEnum;
use App\Enums\TransactionOrderStatusEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Models\TradingAccount;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class Index extends FormRequest
{
    use ResponseTrait;
    public function rules(): array
    {
        return [
            'brand_id' => 'required|exists:brands,public_key',
        ];
    }

}