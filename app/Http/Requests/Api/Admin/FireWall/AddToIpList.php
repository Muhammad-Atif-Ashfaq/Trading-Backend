<?php

namespace App\Http\Requests\Api\Admin\FireWall;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class AddToIpList extends FormRequest
{
    use ResponseTrait; // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'ip_address' => ['required','string','max:255', 'unique:ip_list,ip_address'],
            'brand_id'  => ['required'],
            'status' => ['required','in:No,Yes'],
        ];
    }
}
