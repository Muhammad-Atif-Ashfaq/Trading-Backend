<?php
namespace App\Traits\Models;

use App\Enums\LeverageEnum;
use Illuminate\Database\Eloquent\Builder;

trait HasSearch
{
    public function scopeWhereSearch(Builder $query, $request)
    {
        $fillable = skipValue0($request->only($this->fillable));
        $appends = $this->appends;
        $appendRequest = skipValue0($request->only($appends));

        if (count($fillable) || count($appendRequest)) {
            $query->where(function ($query) use ($fillable, $appendRequest, $appends) {
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

                // Check for appended accessor attributes
                foreach ($appends as $accessor) {
                    if (isset($appendRequest[$accessor])) {
                        $parts = explode('_', $accessor);
                        $column = array_pop($parts); // Last part is the column name
                        $relation = \Illuminate\Support\Str::studly(implode('_', $parts)); // Remaining parts form the relation path

                        $query->orWhereHas($relation, function ($q) use ($appendRequest, $accessor, $column) {
                            $q->where($column, 'like', '%' . $appendRequest[$accessor] . '%');
                        });
                    }
                }
            });
        }

        return $query;
    }
}
