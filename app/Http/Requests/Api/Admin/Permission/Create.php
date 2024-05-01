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
            'user_id' => 'required',
            'permissions' => 'required|array',
        ];
    }


}
