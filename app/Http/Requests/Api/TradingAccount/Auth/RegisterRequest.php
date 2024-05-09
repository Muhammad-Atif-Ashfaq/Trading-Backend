<?php

namespace App\Http\Requests\Api\TradingAccount\Auth;


use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'brand_id' => ['required', 'string', 'exists:brands,public_key'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }
}
