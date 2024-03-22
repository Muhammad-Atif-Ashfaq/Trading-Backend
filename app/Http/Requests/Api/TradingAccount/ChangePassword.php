<?php

namespace App\Http\Requests\Api\TradingAccount;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'login_id' => 'required|string',
            'new_password' => 'required|string'
        ];
    }
}
