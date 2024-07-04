<?php

namespace App\Http\Requests\Api\Terminal\Auth;

use App\Rules\BrandBelongsToTradingAccount;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'login_id' => 'required|exists:trading_accounts,login_id',
            'password' => 'required',
            'brand_id' => ['required', new BrandBelongsToTradingAccount($this->login_id, 'login_id')],
        ];
    }
}
