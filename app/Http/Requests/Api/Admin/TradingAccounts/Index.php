<?php

namespace App\Http\Requests\Api\Admin\TradingAccounts;

use App\Enums\TradingAccountStatusEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
{
    use ResponseTrait;
    public function rules(): array
    {
        return [
            'status' => 'nullable|in:' . implode(',', TradingAccountStatusEnum::getStatuses()),
            'per_page' => 'nullable',
            'page' => 'nullable',
        ];
    }
}
