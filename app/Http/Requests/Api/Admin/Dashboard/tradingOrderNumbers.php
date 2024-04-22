<?php

namespace App\Http\Requests\Api\Admin\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class tradingOrderNumbers extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'start_date' => 'nullable',
            'start_date' => 'nullable'
        ];
    }
}
