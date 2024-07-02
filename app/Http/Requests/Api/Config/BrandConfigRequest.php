<?php

namespace App\Http\Requests\Api\Config;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class BrandConfigRequest extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'brand_id' => 'required|string',
        ];
    }
}