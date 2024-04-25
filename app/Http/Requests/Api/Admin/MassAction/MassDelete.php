<?php

namespace App\Http\Requests\Api\Admin\MassAction;

use App\Rules\TableNameExists;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class MassDelete extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'table_name' => ['required', 'string', new TableNameExists()],
            'table_ids' => ['nullable', 'array'],
        ];
    }
}
