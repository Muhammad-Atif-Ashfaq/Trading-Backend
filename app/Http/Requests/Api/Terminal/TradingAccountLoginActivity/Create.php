<?php

namespace App\Http\Requests\Api\Terminal\TradingAccountLoginActivity;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'trading_account_id' => 'required',
            'ip_address' => 'required',
            'login_time' => 'required',
        ];
    }
}
