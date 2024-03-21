<?php

namespace App\Http\Requests\Api\Admin\TradingGroups;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait;
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'mass_trading_orders' => 'nullable|numeric',
            'mass_transaction_orders' => 'nullable|numeric',
            'mass_leverage' => 'nullable|string',
            'mass_swap' => 'nullable|string',
        ];
    }
}
