<?php

namespace App\Http\Requests\Api\Admin\Permission;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class Create extends FormRequest
{
    use ResponseTrait; 

    public function rules(): array
    {
        return [
            'brand_id' => 'required',
            'model_permission' => 'required|string',
        ];
    }
}
