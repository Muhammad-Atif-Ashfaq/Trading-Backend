<?php

namespace App\Http\Requests\Api\Admin\SymbelGroups;

use App\Enums\LeverageEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:symbel_groups,name',
            'leverage' => 'required|string|max:255|in:'. implode(',', LeverageEnum::getLeverages()),
            'lot_size' => 'required|string|max:255',
            'lot_step' => 'required|string|max:255',
            'vol_min' => 'required|string|max:255',
            'vol_max' => 'required|string|max:255',
            'trading_interval' => 'nullable',
            'swap'    =>  'required'
        ];
    }
}
