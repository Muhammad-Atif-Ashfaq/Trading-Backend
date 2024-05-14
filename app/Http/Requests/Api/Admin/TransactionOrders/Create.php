<?php

namespace App\Http\Requests\Api\Admin\TransactionOrders;

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

    // TODO: Using the ResponseTrait for sending responses

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
            'type' => 'required|in:' . implode(',', TransactionOrderTypeEnum::getTypes()),
            'method' => 'required|in:' . implode(',', TransactionOrderMethodEnum::getMethods()),
            'status' => 'nullable|in:' . implode(',', TransactionOrderStatusEnum::getStatuses()),
            'comment' => 'nullable|string',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $data = $validator->validated();
                $method = $data['method'];

                //  type is "withdraw", and trading_account_id is provided
                if ($data['type'] === TransactionOrderTypeEnum::WITHDRAW && isset($data['trading_account_id'])) {
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
            }
        ];
    }

}
