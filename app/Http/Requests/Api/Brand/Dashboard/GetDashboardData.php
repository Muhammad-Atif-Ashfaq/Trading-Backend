<?php

namespace App\Http\Requests\Api\Brand\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class GetDashboardData extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'types' => 'required|array'
        ];
    }
}
