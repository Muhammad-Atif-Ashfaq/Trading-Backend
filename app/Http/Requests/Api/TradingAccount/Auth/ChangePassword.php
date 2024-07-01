<?php

namespace App\Http\Requests\Api\TradingAccount\Auth;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'new_password' => 'required|string',
            'user_id' => 'required'
        ];
    }
}