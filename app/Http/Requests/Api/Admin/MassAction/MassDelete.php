<?php

namespace App\Http\Requests\Api\Admin\MassAction;

use App\Rules\TableNameExists;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class MassDelete extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'table_name' => ['required', 'string', new TableNameExists()],
            'table_ids' => ['nullable', 'array'],
            'column_name' => ['nullable', 'string'],
            'skip' => ['nullable', 'boolean']
        ];
    }




    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();

            $table_name = $data['table_name'];
            $skip = $data['skip'] ?? false;
            $table_ids = $data['table_ids'] ?? [];

            [$hasChildDataIds, $childModels] = $this->getChildDataIds($table_name, $table_ids);

            if (!empty($hasChildDataIds)) {
                if ($skip) {
                    $data['table_ids'] = array_diff($table_ids, $hasChildDataIds);
                } else {
                    $childModelList = implode(', ', $childModels);
                    $validator->errors()->add('table_ids', "Associated data found in: $childModelList. Do you want to skip these entries?: " . implode(', ', $hasChildDataIds));
                }
            }
        });
    }

    private function getChildDataIds(string $table_name, array $ids): array
    {
        $relatedModels = config('massdelete');
        $hasChildDataIds = [];
        $childModels = [];

        if (isset($relatedModels[$table_name])) {
            $primaryModelClass = tableToModel($table_name);
            $items = $primaryModelClass::whereIn('id', $ids)->get();

            foreach ($items as $item) {
                foreach ($relatedModels[$table_name] as $relation) {
                    $relatedModelClass = $relation['model']::query();
                    foreach ($relation['keys'] as $primaryKey => $relatedKey) {
                        $relatedModelClass = $relatedModelClass->where($relatedKey, $item->$primaryKey);
                    }
                    if ($relatedModelClass->exists()) {
                        $hasChildDataIds[] = $item->id;
                        $childModels[] = str_replace('App\\Models\\','',$relation['model']);
                        break 2; // Break both loops as we already found a relation
                    }
                }
            }
        }

        return [array_unique($hasChildDataIds), array_unique($childModels)];
    }
}