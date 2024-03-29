<?php

namespace App\Traits\Models;


trait HasGroupUniqueId
{
    public function scopeFindGroupUniqueId($query, $group_unique_id)
    {
        return $query->where('group_unique_id', $group_unique_id)->groupBy('group_unique_id')->first();
    }

    public function scopeWhereGroupUniqueId($query, $group_unique_id)
    {
        return $query->where('group_unique_id', $group_unique_id);
    }
}
