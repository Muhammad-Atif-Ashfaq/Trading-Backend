<?php

namespace App\Http\Requests\Api\Admin\MassAction;

use App\Rules\TableNameExists;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class MassImport extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'table_name' => ['required', 'string', new TableNameExists()],
            'rows' => ['required', 'array'],
            'marge_col' => ['nullable', 'array'],
            'skip' => ['required', 'in:skip,marge']
        ];
    }
}
