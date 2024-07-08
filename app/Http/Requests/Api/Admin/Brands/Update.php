<?php

namespace App\Http\Requests\Api\Admin\Brands;

use App\Enums\LeverageEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255', 'unique:brands,name', 'unique:users,name'],
            'domain' => ['nullable', 'string', 'max:255', 'unique:brands,domain'],
            'margin_call' => ['nullable'],
            'leverage' => ['nullable', 'string', 'max:255', 'in:'.implode(',', LeverageEnum::getLeverages())],
            'stop_out' => ['nullable', 'string'],
        ];
    }
}
