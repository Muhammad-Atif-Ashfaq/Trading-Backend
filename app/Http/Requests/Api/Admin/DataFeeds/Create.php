<?php

namespace App\Http\Requests\Api\Admin\DataFeeds;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    use ResponseTrait;
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'module' => 'required|string|max:255',
            'feed_server' => 'required|string|max:255',
            'feed_login' => 'nullable|string|max:255',
            'feed_password' => 'nullable|string|max:255',
        ];
    }
}
