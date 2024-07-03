<?php

namespace App\Http\Requests\Api\Brand\TradingGroups;

use App\Enums\LeverageEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'brand_id' => 'required|exists:brands,public_key',
        ];
    }
}