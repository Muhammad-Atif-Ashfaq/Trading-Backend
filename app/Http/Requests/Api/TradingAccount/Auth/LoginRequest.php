<?php

namespace App\Http\Requests\Api\TradingAccount\Auth;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }
}
