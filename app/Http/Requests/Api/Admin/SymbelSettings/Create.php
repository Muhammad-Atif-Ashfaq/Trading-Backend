<?php

namespace App\Http\Requests\Api\Admin\SymbelSettings;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait;
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'symbel_group_id' => 'nullable|exists:symbel_groups,id',
            'speed_min' => 'nullable|string|max:255',
            'speed_max' => 'nullable|string|max:255',
            'lot_size' => 'nullable|string|max:255',
            'lot_step' => 'nullable|string|max:255',
            'commission' => 'nullable|string|max:255',
            'swap_long' => 'nullable|string|max:255',
            'swap_short' => 'nullable|string|max:255',
            'enabled' => 'nullable|boolean',
            'viable' => 'nullable|boolean',
        ];
    }
}
