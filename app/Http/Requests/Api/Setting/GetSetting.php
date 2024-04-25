<?php

namespace App\Http\Requests\Api\Setting;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class GetSetting extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'names' => ['required','array'],
        ];
    }
}
