<?php

namespace App\Http\Requests\Api\Admin\TransactionOrders;

use App\Enums\TransactionOrderMethodEnum;
use App\Enums\TransactionOrderStatusEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Rules\BrandBelongsToTradingAccount;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'amount' => 'nullable|numeric',
            'currency' => 'nullable|string',
            'trading_account_id' => 'nullable|exists:trading_accounts,id',
            'brand_id' => ['nullable', 'exists:brands,public_key', new BrandBelongsToTradingAccount($this->input('trading_account_id'), 'id')],
            'group_unique_id' => 'nullable|string',
            'name' => 'nullable|string',
            'group' => 'nullable|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'type' => 'nullable|in:'.implode(',', TransactionOrderTypeEnum::getTypes()),
            'method' => 'nullable|in:'.implode(',', TransactionOrderMethodEnum::getMethods()),
            'status' => 'nullable|in:'.implode(',', TransactionOrderStatusEnum::getStatuses()),
            'comment' => 'nullable|string',
        ];
    }
}
