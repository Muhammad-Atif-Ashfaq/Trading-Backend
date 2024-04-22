<?php

namespace App\Http\Requests\Api\Admin\SymbelSettings;

use App\Enums\LeverageEnum;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:symbel_settings,name',
            'symbel_group_id' => 'nullable|exists:symbel_groups,id',
            'feed_name' => 'string|exists:data_feeds,name',
            'feed_server' => 'nullable|string',
            'feed_fetch_name' => 'required|string|unique:symbel_settings,feed_fetch_name',
            'speed_max' => 'nullable|string|max:255',
            'leverage' => 'nullable|string|max:255|in:' . implode(',', LeverageEnum::getLeverages()),
            'swap' => 'nullable|string|max:255',
            'lot_size' => 'nullable|string|max:255',
            'lot_step' => 'nullable|string|max:255',
            'vol_min' => 'nullable|string|max:255',
            'vol_max' => 'nullable|string|max:255',
            'commission' => 'nullable|string|max:255',
            'enabled' => 'nullable|boolean',
        ];
    }
}
