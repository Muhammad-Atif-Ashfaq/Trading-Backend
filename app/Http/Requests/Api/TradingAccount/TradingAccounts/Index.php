<?php

namespace App\Http\Requests\Api\TradingAccount\TradingAccounts;

use App\Enums\TradingAccountStatusEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'status' => 'nullable|in:' . implode(',', TradingAccountStatusEnum::getStatuses()),
            'per_page' => 'nullable',
            'page' => 'nullable',
            'brand_id' => 'nullable|exists:brands,public_key',
        ];
    }
}
