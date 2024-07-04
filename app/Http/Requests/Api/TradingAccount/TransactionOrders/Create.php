<?php

namespace App\Http\Requests\Api\TradingAccount\TransactionOrders;

use App\Enums\TransactionOrderMethodEnum;
use App\Enums\TransactionOrderStatusEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Models\TradingAccount;
use App\Rules\BrandBelongsToTradingAccount;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'amount' => 'required|string',
            'currency' => 'required|string',
            'trading_account_id' => 'required|exists:trading_accounts,id',
            'brand_id' => ['required', 'exists:brands,public_key', new BrandBelongsToTradingAccount($this->input('trading_account_id'), 'id')],
            'name' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
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

            if (isset($data['type'], $data['method'])) {
                if ($data['type'] === TransactionOrderTypeEnum::WITHDRAW && isset($data['trading_account_id'])) {

                    $tradingAccount = TradingAccount::find($data['trading_account_id']);

                    if ($tradingAccount) {

                        $account = $tradingAccount->{$data['method']};

                        if ($account < $data['amount']) {

                            $validator->errors()->add('amount', 'Insufficient '.ucfirst($data['method']).' for withdrawal');
                        }
                    }
                }
            } else {

                if (! isset($data['type'])) {
                    $validator->errors()->add('type', 'The type field is required.');
                }
                if (! isset($data['method'])) {
                    $validator->errors()->add('method', 'The method field is required.');
                }
            }
        });
    }
}
