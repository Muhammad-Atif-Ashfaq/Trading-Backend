<?php

namespace App\Http\Requests\Api\Admin\MassAction;

use App\Rules\TableNameExists;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class MassExport extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'table_name' => ['required', 'string', new TableNameExists()],
            'delimiter' => ['required', 'string'],
            'table_ids' => ['nullable', 'array'],
            'column_name' => ['nullable', 'string'],
            'export_columns' => ['required','array']
        ];
    }
}
