<?php

namespace App\Http\Requests\Api\Admin\DataFeeds;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'module' => 'nullable|string|max:255',
            'enabled' => 'nullable',
            'feed_server' => 'nullable|string|max:255',
            'feed_login' => 'nullable|string|max:255',
            'feed_password' => 'nullable|string|max:255',
        ];
    }
}
