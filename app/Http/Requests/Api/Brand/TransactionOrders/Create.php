<?php

namespace App\Http\Requests\Api\Brand\TransactionOrders;

use App\Enums\TransactionOrderMethodEnum;
use App\Enums\TransactionOrderStatusEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Models\TradingAccount;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class Create extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'amount' => 'required|string',
            'currency' => 'nullable|string',
            'trading_account_id' => 'required|exists:trading_accounts,id',
            'brand_id' => 'required|exists:brands,public_key',
            'group_unique_id' => 'nullable|string',
            'name' => 'nullable|string',
            'group' => 'nullable|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'type' => 'required|in:'.implode(',', TransactionOrderTypeEnum::getTypes()),
            'method' => 'required|in:'.implode(',', TransactionOrderMethodEnum::getMethods()),
            'status' => 'nullable|in:'.implode(',', TransactionOrderStatusEnum::getStatuses()),
            'comment' => 'nullable|string',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();

            // type is "withdraw", and trading_account_id is provided
            if (isset($data['type']) && isset($data['method']) && $data['type'] === TransactionOrderTypeEnum::WITHDRAW && isset($data['trading_account_id'])) {
                $method = $data['method'];
                // Get the trading account
                $tradingAccount = TradingAccount::find($data['trading_account_id']);

                // Check if trading account exists
                if ($tradingAccount) {
                    // Get the account balance
                    $account = $tradingAccount->$method;

                    // Check if account balance is greater than or equal to the withdrawal amount
                    if ($account < $data['amount']) {
                        // Add an error to the validator
                        $validator->errors()->add('amount', 'Insufficient '.ucfirst($method).' for withdrawal');
                    }
                }
            }
        });
    }
}
