<?php

namespace App\Http\Requests\Api\TradingAccount\TradingAccounts;

use App\Enums\TradingAccountStatusEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\BrandBelongsToUser;

class GetAll extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'brand_id' => [
                'required',
                'exists:brands,public_key',
                new BrandBelongsToUser($this->input('brand_customer_id'))
            ],
            'brand_customer_id' => 'required|exists:users,id',
        ];
    }
}