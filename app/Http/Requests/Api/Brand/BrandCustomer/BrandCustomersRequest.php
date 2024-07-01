<?php

namespace App\Http\Requests\Api\Brand\BrandCustomer;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class BrandCustomersRequest extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'brand_id' => 'required|string',
        ];
    }
}