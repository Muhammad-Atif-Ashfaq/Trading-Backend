<?php

namespace App\Http\Requests\Api\TradingAccount;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'login_id' => 'required|string',
            'new_password' => 'required|string'
        ];
    }
}
