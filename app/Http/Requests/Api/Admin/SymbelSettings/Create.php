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
            'feed_name' => 'string|exists:data_feeds,module',
            'feed_server' => 'string',
            'feed_fetch_name' => 'required|string|unique:symbel_settings,feed_fetch_name',
            'feed_fetch_key' => 'nullable|string|in:forex,crypto,stock',
            'speed_max' => 'string|max:255',
            'leverage' => 'string|max:255|in:' . implode(',', LeverageEnum::getLeverages()),
            'swap' => 'string|max:255',
            'pip' => 'required',
            'lot_size' => 'string|max:255',
            'lot_step' => 'string|max:255',
            'vol_min' => 'string|max:255',
            'vol_max' => 'string|max:255',
            'commission' => 'string|max:255',
            'enabled' => 'nullable|boolean',
        ];
    }
}
