<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Builder;

trait HasGroupUniqueId
{

    // TODO: Scope a query to all.
    public function scopeAllGroupUniqueId(Builder $query)
    {
        return $query->whereNotNull('group_unique_id')->groupBy('group_unique_id');
    }

    // TODO: Scope a query to find a model by its group unique ID.
    public function scopeFindGroupUniqueId(Builder $query, $group_unique_id)
    {
        return $query->where('group_unique_id', $group_unique_id)->groupBy('group_unique_id')->first();
    }

    // TODO: Scope a query to filter models by their group unique ID.
    public function scopeWhereGroupUniqueId(Builder $query, $group_unique_id)
    {
        return $query->where('group_unique_id', $group_unique_id);
    }
}
