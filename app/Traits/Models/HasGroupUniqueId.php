<?php

namespace App\Traits\Models;


trait HasGroupUniqueId
{

    // TODO: Scope a query to find a model by its group unique ID.
    public function scopeFindGroupUniqueId($query, $group_unique_id)
    {
        return $query->where('group_unique_id', $group_unique_id)->groupBy('group_unique_id')->first();
    }

    // TODO: Scope a query to filter models by their group unique ID.
    public function scopeWhereGroupUniqueId($query, $group_unique_id)
    {
        return $query->where('group_unique_id', $group_unique_id);
    }
}
