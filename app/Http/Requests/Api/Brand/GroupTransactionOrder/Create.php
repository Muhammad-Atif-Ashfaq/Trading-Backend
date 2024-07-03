<?php

namespace App\Http\Requests\Api\Brand\GroupTransactionOrder;

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
            'trading_group_id' => 'required|exists:trading_groups,id',
            'name' => 'nullable|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'type' => 'required|in:' . implode(',', TransactionOrderTypeEnum::getTypes()),
            'method' => 'required|in:' . implode(',', TransactionOrderMethodEnum::getMethods()),
            'status' => 'required|in:' . implode(',', TransactionOrderStatusEnum::getStatuses()),
            'comment' => 'nullable|string',
            'skip' => 'nullable|boolean',
            'brand_id' => 'required|exists:brands,public_key',
        ];
    }


    public function after(): array
    {
        return [
            function (Validator $validator) {
                $data = $validator->validated();
                $method = $data['method'];
                $skipAccounts = $data['skip'] ?? false;

                // type is "withdraw", and trading_account_id is provided
                if ( $data['type'] === TransactionOrderTypeEnum::WITHDRAW) {
                    // Get the trading account
                    $lowAccounts = TradingAccount::where('trading_group_id',$data['trading_group_id'])
                        ->where($method ,'<',(int)$data['amount'])
                        ->pluck('login_id')
                        ->toArray();

                    // Check if trading account exists
                    if (count($lowAccounts)) {
                        if (!$skipAccounts) {
                            $validator->errors()->add('balance', 'Insufficient '.ucfirst($method).' for withdrawal for accounts: ' . implode(', ', $lowAccounts));
                        }
                    }
                }

            }
        ];
    }
}