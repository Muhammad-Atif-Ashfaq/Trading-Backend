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
            'types' => 'required|array',
            'types.*' => 'in:trading_order_by_numbers,trading_order_by_numbers,trading_volume_by_lots,deposits',
            'brand_id'=>'required|exists:brands,public_key'
        ];
    }
}