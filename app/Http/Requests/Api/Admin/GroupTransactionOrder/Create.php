<?php

namespace App\Http\Requests\Api\Admin\GroupTransactionOrder;

use App\Enums\TransactionOrderMethodEnum;
use App\Enums\TransactionOrderStatusEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait;
    public function rules(): array
    {
        return [
            'amount' => 'required|string',
            'currency' => 'nullable|string',
            'trading_account_id' => 'required|exists:trading_accounts,id',
            'trading_group_id' => 'required|exists:trading_groups,id',
            'brand_id' => 'required|exists:brands,public_key',
            'name' => 'nullable|string',
            'group' => 'required|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'type' => 'required|in:' . implode(',', TransactionOrderTypeEnum::getTypes()),
            'method' => 'required|in:' . implode(',', TransactionOrderMethodEnum::getMethods()),
            'status' => 'required|in:' . implode(',', TransactionOrderStatusEnum::getStatuses()),
            'comment' => 'nullable|string',
        ];
    }
}
