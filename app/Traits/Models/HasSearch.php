<?php

namespace App\Traits\Models;


use App\Enums\LeverageEnum;
use App\Helpers\SystemHelper;

trait HasSearch
{
    // TODO:Create a new trade order.
    // TODO: Create a new trade order.
    public function scopeWhereSearch($query, $request)
    {
        $fillable = skipValue0($request->only($this->fillable));

        if (count($fillable)) {
            $query->where(function ($query) use ($fillable) {
                foreach ($fillable as $column => $value) {
                    if ($column === 'leverage') {
                        $query->whereIn($column, LeverageEnum::getValuesFromText($value));
                    } else {
                        if (is_array($value)) {
                            $query->whereIn($column, $value);
                        } else {
                            $query->where($column, 'like', '%' . $value . '%');
                        }
                    }
                }
            });
        }

        return $query;
    }

}
