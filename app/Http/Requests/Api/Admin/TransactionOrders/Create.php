<?php

namespace App\Http\Requests\Api\Admin\TransactionOrders;

use App\Enums\TransactionOrderMethodEnum;
use App\Enums\TransactionOrderStatusEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'amount' => 'required|string',
            'currency' => 'nullable|string',
            'trading_account_id' => 'required|exists:trading_accounts,id',
            'brand_id' => 'required|exists:brands,public_key',
            'group_unique_id'    => 'nullable|string',
            'name' => 'nullable|string',
            'group' => 'nullable|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'type' => 'required|in:' . implode(',', TransactionOrderTypeEnum::getTypes()),
            'method' => 'required|in:' . implode(',', TransactionOrderMethodEnum::getMethods()),
            'status' => 'nullable|in:' . implode(',', TransactionOrderStatusEnum::getStatuses()),
            'comment' => 'nullable|string',
        ];
    }
}
