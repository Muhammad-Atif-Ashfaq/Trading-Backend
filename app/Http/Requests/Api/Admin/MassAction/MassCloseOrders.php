<?php

namespace App\Http\Requests\Api\Admin\MassAction;


use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class MassCloseOrders extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'ids' => ['required', 'array'],
        ];
    }
}
