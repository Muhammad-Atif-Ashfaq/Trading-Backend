<?php

namespace App\Http\Requests\Api\Admin\TradingAccounts;

use App\Enums\LeverageEnum;
use App\Enums\TradingAccountStatusEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'trading_group_id' => 'nullable|exists:trading_groups,id',
            'brand_id' => 'nullable|exists:brands,id',
            'public_key' => 'nullable|string',
            'login_id' => 'nullable|string',
            'password' => 'nullable|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
            'name' => 'nullable|string',
            'email' => 'nullable|string|email',
            'leverage' => 'nullable|string|max:255|in:'. implode(',', LeverageEnum::getLeverages()),
            'balance' => 'nullable|string',
            'credit' => 'nullable|string',
            'equity' => 'nullable|string',
            'margin_level_percentage' => 'nullable|string',
            'profit' => 'nullable|string',
            'swap' => 'nullable|string',
            'currency' => 'nullable|string',
            'registration_time' => 'nullable|string',
            'last_access_time' => 'nullable|string',
            'last_access_address_IP' => 'nullable|string|ip',
            'status' => 'nullable|in:' . implode(',', TradingAccountStatusEnum::getStatuses()),
        ];
    }
}
