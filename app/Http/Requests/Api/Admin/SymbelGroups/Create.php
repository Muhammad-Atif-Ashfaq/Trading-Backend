<?php

namespace App\Http\Requests\Api\Admin\SymbelGroups;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait;
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'Leverage' => 'required|string|max:255',
            'lot_size' => 'required|string|max:255',
            'lot_step' => 'required|string|max:255',
            'vol_min' => 'required|string|max:255',
            'vol_max' => 'required|string|max:255',
            'trading_interval' => 'nullable|string|max:255',
        ];
    }
}
