<?php

namespace App\Http\Requests\Api\Brand\BrandLoginActivity;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class Index extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
        ];
    }
}