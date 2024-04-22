<?php

namespace App\Http\Requests\Api\Admin\ChangePassword;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class ChangePassword extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'new_password' => 'required|string'
        ];
    }
}
