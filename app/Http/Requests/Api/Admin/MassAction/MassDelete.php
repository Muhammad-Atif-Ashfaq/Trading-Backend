<?php

namespace App\Http\Requests\Api\Admin\MassAction;

use App\Models\SymbelSetting;
use App\Models\TradeOrder;
use App\Models\TradingAccount;
use App\Rules\TableNameExists;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class MassDelete extends FormRequest
{
    use ResponseTrait;

    // TODO: Using the ResponseTrait for sending responses

    public function rules(): array
    {
        return [
            'table_name' => ['required', 'string', new TableNameExists()],
            'table_ids' => ['nullable', 'array'],
            'column_name' => ['nullable', 'string'],
            'skip' => ['nullable', 'boolean']
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $data = $validator->validated();

                $table_name = $data['table_name'];
                $skipAccounts = $data['skip'] ?? false;

                if ($table_name == 'symbel_settings') {

                    $symbols = SymbelSetting::when(isset($data['table_ids']),function ($q) use ($data){
                        $q->whereIn('id', $data['table_ids']);
                    })->get();

                    // Find symbols with associated orders
                    $hasOrderSymbols = $symbols->filter(function ($symbol) {
                        return TradeOrder::whereIn('symbol', [$symbol->feed_fetch_name])->exists();
                    })->pluck('feed_fetch_name')->toArray();

                    // // If associated orders found and skipping is not enabled, add an error
                    if (!empty($hasOrderSymbols) && !$skipAccounts) {
                        $validator->errors()->add('table_ids', 'Associated orders found. Do you want to skip these entries?: ' . implode(', ', $hasOrderSymbols));
                    }
                }



            }

        ];
    }
}
