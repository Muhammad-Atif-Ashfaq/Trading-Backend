<?php

namespace App\Http\Requests\Api\Setting;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class SetSetting extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'data' => ['required','array'],
            'data.name' => ['required','string'],
            'data.value' => ['nullable'],
        ];
    }
}
