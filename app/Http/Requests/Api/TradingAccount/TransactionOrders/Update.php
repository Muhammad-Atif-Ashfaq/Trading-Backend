<?php

namespace App\Http\Requests\Api\TradingAccount\TransactionOrders;

use App\Enums\TransactionOrderMethodEnum;
use App\Enums\TransactionOrderStatusEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Models\TradingAccount;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class Update extends FormRequest
{
    use ResponseTrait;

    // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'amount' => 'nullable|string',
            'currency' => 'nullable|string',
            'trading_account_id' => 'nullable|exists:trading_accounts,id',
            'brand_id' => 'nullable|exists:brands,public_key',
            'name' => 'nullable|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'type' => 'nullable|in:' . implode(',', TransactionOrderTypeEnum::getTypes()),
            'method' => 'nullable|in:' . implode(',', TransactionOrderMethodEnum::getMethods()),
            'status' => 'nullable|in:' . implode(',', TransactionOrderStatusEnum::getStatuses()),
            'comment' => 'nullable|string',
        ];
    }

}